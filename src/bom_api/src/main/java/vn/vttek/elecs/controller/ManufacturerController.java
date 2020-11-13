package vn.vttek.elecs.controller;

import java.util.Arrays;
import java.util.List;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Sort;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import vn.vttek.elecs.entities.Manufacturer;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.ManufacturerRepository;

@RestController
@RequestMapping("/manufacturer")
public class ManufacturerController {

	@Autowired
	private ManufacturerRepository manufacturerRepository;

	@RequestMapping(path = "/getListManufacturer", method = RequestMethod.GET)
	public List<Manufacturer> getListDepartment(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<Manufacturer> deps = manufacturerRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return deps;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Manufacturer[] { manufacturerRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				System.err.println(e);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}

	}

	@PostMapping("/addNewManufacturer")
	public Manufacturer createQuestion(@Valid @RequestBody Manufacturer manufacturer) {
		return manufacturerRepository.save(manufacturer);
	}

	@PutMapping("/updateManufacturer/{manufacturerId}")
	public Manufacturer updateManufacturer(@PathVariable Long manufacturerId,
			@Valid @RequestBody Manufacturer manufacturerRequest) {
		return manufacturerRepository.findById(manufacturerId).map(manufacturer -> {
			manufacturer.setCreated_by_id(manufacturerRequest.getCreated_by_id());
			manufacturer.setName(manufacturerRequest.getName());
			manufacturer.setPhone(manufacturerRequest.getPhone());
			manufacturer.setState(manufacturerRequest.getState());
			manufacturer.setContact_name(manufacturerRequest.getContact_name());
			manufacturer.setModified_on(manufacturerRequest.getModified_on());

			return manufacturerRepository.save(manufacturer);
		}).orElseThrow(() -> new ResourceNotFoundException("Manufacturer not found with id " + manufacturerId));
	}

	@DeleteMapping("/deleteManufacturer/{manufacturerId}")
	public ResponseEntity<?> deleteManufacturer(@PathVariable Long manufacturerId) {
		return manufacturerRepository.findById(manufacturerId).map(manufacturer -> {
			manufacturerRepository.delete(manufacturer);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("Manufacturer not found with id " + manufacturerId));
	}

	@RequestMapping(path = "/getManuNameById", method = RequestMethod.GET)
	public String getManuNameById(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			long longId = Long.parseLong(id);
			return manufacturerRepository.findById(longId).map(manufacturer -> {
				return manufacturer.getName();
			}).orElseThrow(() -> new ResourceNotFoundException("Manufacturer not found with id " + longId));
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;

	}

	@GetMapping("/getOrCreateManuByName/{name}/{id}")
	public Manufacturer getOrCreateManuByName(@PathVariable String name, @PathVariable int id) {
		Manufacturer manu = manufacturerRepository.findByName(name);

		if (manu != null)
			return manu;

		manu = new Manufacturer();
		manu.setName(name);
		manu.setCreated_by_id(id);

		return manufacturerRepository.save(manu);
	}

	@RequestMapping(path = "/checkManuName", method = RequestMethod.GET)
	public Boolean checkDepartmentName(@RequestParam String name) {
		return manufacturerRepository.existsByName(name);
	}

}
