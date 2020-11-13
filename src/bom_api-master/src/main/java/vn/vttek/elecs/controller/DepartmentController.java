package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Sort;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import vn.vttek.elecs.entities.Department;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.model.DeparmentModel;
import vn.vttek.elecs.repository.AccountRepository;
import vn.vttek.elecs.repository.DepartmentRepository;
import javax.validation.Valid;
import java.awt.print.Pageable;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

@RestController
@RequestMapping("/department")
public class DepartmentController {

	@Autowired
	private DepartmentRepository departmentRepository;

	@Autowired
	private AccountRepository accountRepository;

	@GetMapping("/department")
	public Page<Department> getDepartment(Pageable pageable) {
		return (Page<Department>) departmentRepository.findAll();
	}

	@PostMapping("/addNewDepartment")
	public ResponseEntity<String> addNewDepartment(@Valid @RequestBody Department department) {
		if (departmentRepository.existsByName(department.getName())) {
			return new ResponseEntity<String>("NAME_EXISTED", HttpStatus.BAD_REQUEST);
		}

		if (departmentRepository.existsByCode(department.getCode())) {
			return new ResponseEntity<String>("CODE_EXISTED", HttpStatus.BAD_REQUEST);
		}
		departmentRepository.save(department);
		return ResponseEntity.ok().body("Create department successfully!");
	}

	@PutMapping("/updateDepartment/{departmentId}")
	public Department updateDepartment(@PathVariable Long departmentId,
			@Valid @RequestBody Department departmentRequest) {
		return departmentRepository.findById(departmentId).map(department -> {
			department.setPar_id(departmentRequest.getPar_id());
			department.setCode(departmentRequest.getCode());
			department.setName(departmentRequest.getName());
			department.setDescription(departmentRequest.getDescription());
			department.setModified_on(departmentRequest.getModified_on());

			return departmentRepository.save(department);
		}).orElseThrow(() -> new ResourceNotFoundException("department not found with id " + departmentId));
	}

	@DeleteMapping("/deleteDepartment/{departmentId}")
	public ResponseEntity<?> deleteDepartment(@PathVariable Long departmentId) {
		if (accountRepository.countByDeparmentId(departmentId.toString()) > 0) {
			return new ResponseEntity<String>("DEPARTMENT_USED", HttpStatus.BAD_REQUEST);
		}
		return departmentRepository.findById(departmentId).map(department -> {
			departmentRepository.delete(department);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("department not found with id " + departmentId));
	}

	@RequestMapping(path = "/getListDepartment", method = RequestMethod.GET)
	public List<Department> getListDepartment(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<Department> deps = departmentRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return deps;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Department[] { departmentRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				System.err.println(e);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}

	}

	@RequestMapping(path = "/getDepNameById", method = RequestMethod.GET)
	public String getDepNameById(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			long longId = Long.parseLong(id);
			return departmentRepository.getOne(longId).getName();
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@RequestMapping(path = "/getTreeDepartment", method = RequestMethod.GET)
	public List<DeparmentModel> getTreeDepartment() {
		try {
			List<Department> deps = departmentRepository.findAll();
			List<DeparmentModel> mDeps = new ArrayList<DeparmentModel>();

			for (Department dep : deps) {
				if (dep.getPar_id() != 0)
					continue;
				DeparmentModel model = new DeparmentModel();
				model.setId(dep.getId());
				model.setTitle(dep.getName());

				getDepartmentTree(model, deps);
				mDeps.add(model);
			}
			return mDeps;
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@RequestMapping(path = "/checkDepartmentName", method = RequestMethod.GET)
	public Boolean checkDepartmentName(@RequestParam String name, @RequestParam String code) {
		if (!name.isEmpty()) {
			return departmentRepository.existsByName(name);
		}
		if (!code.isEmpty()) {
			return departmentRepository.existsByCode(code);
		}
		return false;
	}

	private void getDepartmentTree(DeparmentModel mDepartment, List<Department> listDeps) {
		for (Department dep : listDeps) {
			if (mDepartment.getId() == dep.getPar_id()) {
				DeparmentModel model = new DeparmentModel();
				model.setId(dep.getId());
				model.setTitle(dep.getName());

				mDepartment.addSubs(model);
				getDepartmentTree(model, listDeps);
			}

		}
	}
}
