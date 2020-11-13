package vn.vttek.elecs.controller;

import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.Base64;
import java.util.List;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import vn.vttek.elecs.entities.Part;
import vn.vttek.elecs.entities.PartBom;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.PartBomRepository;
import vn.vttek.elecs.repository.PartRepository;
import vn.vttek.elecs.util.Utils;

@RestController
public class PartBomController {
	@Autowired
	private PartBomRepository partbomRepository;
	@Autowired
	private PartRepository partRepository;

	@GetMapping("/partbom")
	public Page<PartBom> getPartBom(Pageable pageable) {
		return (Page<PartBom>) partbomRepository.findAll();
	}

	@PostMapping("/partbom")
	public PartBom createPartBom(@Valid @RequestBody PartBom partbom) {
		return partbomRepository.save(partbom);
	}

	@PutMapping("/partbom/{partbomId}")
	public PartBom updatePartBom(@PathVariable Long partbomId, @Valid @RequestBody PartBom partbomRequest) {
		return partbomRepository.findById(partbomId).map(partbom -> {
			partbom.setClassification(partbomRequest.getClassification());
			partbom.setState(partbomRequest.getState());
			partbom.setCurrent_state(partbomRequest.getCurrent_state());
			partbom.setCreated_on(partbomRequest.getCreated_on());
			partbom.setCreated_by_id(partbomRequest.getCreated_by_id());
			partbom.setModified_on(partbomRequest.getModified_on());
			partbom.setLocked_by_id(partbomRequest.getLocked_by_id());
			partbom.setNot_lockable(partbomRequest.getNot_lockable());
			partbom.setSuperseded_date(partbomRequest.getSuperseded_date());
			partbom.setConfig_id(partbomRequest.getConfig_id());
			partbom.setGeneration(partbomRequest.getGeneration());
			partbom.setIs_released(partbomRequest.getIs_released());
			partbom.setIs_current(partbomRequest.getIs_current());
			partbom.setMajor_rev(partbomRequest.getMajor_rev());
			partbom.setPermission_id(partbomRequest.getPermission_id());
			partbom.setExternal_type(partbomRequest.getExternal_type());
			partbom.setSource_id(partbomRequest.getSource_id());
			partbom.setRelated_id(partbomRequest.getRelated_id());
			partbom.setQuantity(partbomRequest.getQuantity());
			partbom.setSort_ordered(partbomRequest.getSort_ordered());
			partbom.setReference_designator(partbomRequest.getReference_designator());
			return partbomRepository.save(partbom);
		}).orElseThrow(() -> new ResourceNotFoundException("partbom not found with id " + partbomId));
	}

	@DeleteMapping("/partbom/{partbomId}")
	public ResponseEntity<?> deletePartBom(@PathVariable Long partbomId) {
		return partbomRepository.findById(partbomId).map(partbom -> {
			partbomRepository.delete(partbom);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("partbom not found with id " + partbomId));
	}
}
