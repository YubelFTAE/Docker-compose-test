package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import vn.vttek.elecs.entities.PartAlternate;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.PartAlternateRepository;

import javax.validation.Valid;

@RestController
public class PartAlternateController {

    @Autowired
    private PartAlternateRepository partalternateRepository;

    @GetMapping("/partalternate")
    public Page<PartAlternate> getPartAlternate(Pageable pageable) {
        return (Page<PartAlternate>) partalternateRepository.findAll();
    }


    @PostMapping("/partalternate")
    public PartAlternate createPartAlternate(@Valid @RequestBody PartAlternate partalternate) {
        return partalternateRepository.save(partalternate);
    }

    @PutMapping("/partalternate/{partalternateId}")
    public PartAlternate updatePartAlternate(@PathVariable Long partalternateId,
                                             @Valid @RequestBody PartAlternate partAlternate) {
        return partalternateRepository.findById(partalternateId)
                .map(partalternate -> {
                    partalternate.setClassification(partAlternate.getClassification());
                    partalternate.setCreated_on(partAlternate.getCreated_on());
                    partalternate.setManufacturer(partAlternate.getManufacturer());
                    partalternate.setCreated_by_id(partAlternate.getCreated_by_id());
                    partalternate.setModified_on(partAlternate.getModified_on());
                    partalternate.setModified_by_id(partAlternate.getModified_by_id());
                    partalternate.setState(partAlternate.getState());
                    partalternate.setLocked_by_id(partAlternate.getLocked_by_id());
                    partalternate.setCurrent_state(partAlternate.getCurrent_state());
                    partalternate.setMajor_rev(partAlternate.getMajor_rev());
                    partalternate.setIs_current(partAlternate.isIs_current());
                    partalternate.setIs_released(partAlternate.isIs_released());
                    partalternate.setNot_lockable(partAlternate.isNot_lockable());
                    partalternate.setGeneration(partAlternate.getGeneration());
                    partalternate.setPermission_id(partAlternate.getPermission_id());
                    partalternate.setConfig_id(partAlternate.getConfig_id());
                    partalternate.setSource_id(partAlternate.getSource_id());
                    partalternate.setRelated_id(partAlternate.getRelated_id());
                    partalternate.setSort_order(partAlternate.getSort_order());
                    return partalternateRepository.save(partalternate);
                }).orElseThrow(() -> new ResourceNotFoundException("partalternate not found with id " + partalternateId));
    }


    @DeleteMapping("/questions/{questionId}")
    public ResponseEntity<?> deleteQuestion(@PathVariable Long partalternateId) {
        return partalternateRepository.findById(partalternateId)
                .map(question -> {
                    partalternateRepository.delete(question);
                    return ResponseEntity.ok().build();
                }).orElseThrow(() -> new ResourceNotFoundException("partalternate not found with id " + partalternateId));
    }
}

