package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import vn.vttek.elecs.entities.PartBuy;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.PartBuyRepository;

import javax.validation.Valid;

@RestController
@RequestMapping("/partBuy")
public class PartBuyController {

    @Autowired
    private PartBuyRepository partBuyRepository;

    @PostMapping("/addNewPartBuy")
    public PartBuy createPartBuy(@Valid @RequestBody PartBuy partBuy) {
	return partBuyRepository.save(partBuy);
    }

    @PutMapping("/updatePartBuy/{partBuyId}")
    public PartBuy updatePartBuy(@PathVariable Long partBuyId, @Valid @RequestBody PartBuy partBuyRequest) {
	return partBuyRepository.findById(partBuyId).map(partBuy -> {
	    partBuy.setClassification(partBuyRequest.getClassification());
//	    partBuy.setCreated_on(partBuyRequest.getCreated_on());
	    partBuy.setManufacturer(partBuyRequest.getManufacturer());
	    partBuy.setCreated_by_id(partBuyRequest.getCreated_by_id());
	    partBuy.setModified_on(partBuyRequest.getModified_on());
	    partBuy.setModified_by_id(partBuyRequest.getModified_by_id());
	    partBuy.setState(partBuyRequest.getState());
	    partBuy.setLocked_by_id(partBuyRequest.getLocked_by_id());
	    partBuy.setCurrent_state(partBuyRequest.getCurrent_state());
	    partBuy.setMajor_rev(partBuyRequest.getMajor_rev());
//	    partBuy.setIs_current(partBuyRequest.isIs_current());
//	    partBuy.setIs_released(partBuyRequest.isIs_released());
//	    partBuy.setNot_lockable(partBuyRequest.isNot_lockable());
	    partBuy.setGeneration(partBuyRequest.getGeneration());
	    partBuy.setPermission_id(partBuyRequest.getPermission_id());
	    partBuy.setConfig_id(partBuyRequest.getConfig_id());
	    partBuy.setSource_id(partBuyRequest.getSource_id());
	    partBuy.setRelated_id(partBuyRequest.getRelated_id());
	    partBuy.setSort_order(partBuyRequest.getSort_order());
//	    partBuy.setManufacture_id(partBuyRequest.getManufacture_id());
	    partBuy.setVendor_id(partBuyRequest.getVendor_id());
	    return partBuyRepository.save(partBuy);
	}).orElseThrow(() -> new ResourceNotFoundException("partBuy not found with id " + partBuyId));
    }

    @DeleteMapping("/questions/{questionId}")
    public ResponseEntity<?> deleteQuestion(@PathVariable Long partBuyId) {
	return partBuyRepository.findById(partBuyId).map(question -> {
	    partBuyRepository.delete(question);
	    return ResponseEntity.ok().build();
	}).orElseThrow(() -> new ResourceNotFoundException("partBuy not found with id " + partBuyId));
    }
}
