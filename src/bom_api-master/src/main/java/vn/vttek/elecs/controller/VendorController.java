package vn.vttek.elecs.controller;

import java.util.Arrays;
import java.util.List;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Sort;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import vn.vttek.elecs.entities.Vendor;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.VendorRepository;

@RestController
@RequestMapping("/vendor")
public class VendorController {

	@Autowired
	private VendorRepository vendorRepository;

	@RequestMapping(path = "/getListVendor", method = RequestMethod.GET)
	public List<Vendor> getListVendor(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<Vendor> deps = vendorRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return deps;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Vendor[] { vendorRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				System.err.println(e);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}
	}

	@PostMapping("/addNewVendor")
	public Vendor createQuestion(@Valid @RequestBody Vendor vendor) {
		return vendorRepository.save(vendor);
	}

	@PutMapping("/updateVendor/{vendorId}")
	public Vendor updatevendor(@PathVariable Long vendorId, @Valid @RequestBody Vendor vendorRequest) {
		return vendorRepository.findById(vendorId).map(vendor -> {
			vendor.setCreatedById(vendorRequest.getCreatedById());
			vendor.setName(vendorRequest.getName());
			vendor.setPhone(vendorRequest.getPhone());
			vendor.setContactName(vendorRequest.getContactName());
			vendor.setModifiedOn(vendorRequest.getModifiedOn());

			return vendorRepository.save(vendor);
		}).orElseThrow(() -> new ResourceNotFoundException("vendor not found with id " + vendorId));
	}

	@DeleteMapping("/deleteVendor/{vendorId}")
	public ResponseEntity<?> deletevendor(@PathVariable Long vendorId) {
		return vendorRepository.findById(vendorId).map(vendor -> {
			vendorRepository.delete(vendor);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("vendor not found with id " + vendorId));
	}

	@RequestMapping(path = "/getVendorNameById", method = RequestMethod.GET)
	public String getManuNameById(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			long longId = Long.parseLong(id);
			return vendorRepository.findById(longId).map(vendor -> {
				return vendor.getName();
			}).orElseThrow(() -> new ResourceNotFoundException("vendor not found with id " + longId));
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@RequestMapping(path = "/checkVendorName", method = RequestMethod.GET)
	public Boolean checkDepartmentName(@RequestParam String name) {
		return vendorRepository.existsByName(name);
	}

}
