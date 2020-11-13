package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import vn.vttek.elecs.entities.BomInstance;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.BomInstancetRepository;

import javax.validation.Valid;
import java.awt.print.Pageable;

@RestController
public class BomInstanceController {


    @Autowired
    private BomInstancetRepository bominstanceRepository;

    @GetMapping("/bominstance")
    public Page<BomInstance> getBominstance(Pageable pageable) {
        return (Page<BomInstance>) bominstanceRepository.findAll();
    }


    @PostMapping("/bominstance")
    public BomInstance createBominstance(@Valid @RequestBody BomInstance bominstance) {
        return bominstanceRepository.save(bominstance);
    }

    @PutMapping("/bominstance/{bominstanceId}")
    public BomInstance updateBominstance(@PathVariable Long bominstanceId,
                                         @Valid @RequestBody BomInstance bominstanceRequest) {
        return bominstanceRepository.findById(bominstanceId)
                .map(bominstance -> {
                    bominstance.setClassification(bominstanceRequest.getClassification());
                    bominstance.setKeyed_name(bominstanceRequest.getKeyed_name());
                    bominstance.setOwner_by_id(bominstanceRequest.getOwner_by_id());
                    bominstance.setCreate_on(bominstanceRequest.getCreate_on());
                    bominstance.setManufacturer(bominstanceRequest.getManufacturer());
                    bominstance.setCreated_by_id(bominstanceRequest.getCreated_by_id());
                    bominstance.setModified_on(bominstanceRequest.getModified_on());
                    bominstance.setModified_by_id(bominstanceRequest.getModified_by_id());
                    bominstance.setState(bominstanceRequest.getState());
                    bominstance.setLocked_by_id(bominstanceRequest.getLocked_by_id());
                    bominstance.setCurrent_state(bominstanceRequest.getCurrent_state());
                    bominstance.setMajor_rev(bominstanceRequest.getMajor_rev());
                    bominstance.setIs_current(bominstanceRequest.getIs_current());
                    bominstance.setIs_released(bominstanceRequest.getIs_released());
                    bominstance.setNot_lockable(bominstanceRequest.getNot_lockable());
                    bominstance.setGeneration(bominstanceRequest.getGeneration());
                    bominstance.setPermission_id(bominstanceRequest.getPermission_id());
                    bominstance.setConfig_id(bominstanceRequest.getConfig_id());
                    bominstance.setSource_id(bominstanceRequest.getSource_id());
                    bominstance.setRelated_id(bominstanceRequest.getRelated_id());
                    bominstance.setSort_order(bominstanceRequest.getSort_order());
                    bominstance.setX(bominstanceRequest.getX());
                    bominstance.setY(bominstanceRequest.getY());
                    bominstance.setZ(bominstanceRequest.getZ());
                    bominstance.setReference_designator(bominstanceRequest.getReference_designator());
                    bominstance.setSide(bominstanceRequest.getSide());
                    bominstance.setAngle(bominstanceRequest.getAngle());
                    bominstance.setBehavior(bominstanceRequest.getBehavior());
                    bominstance.setTeam_id(bominstanceRequest.getTeam_id());
                    bominstance.setNew_version(bominstanceRequest.getNew_version());
                    bominstance.setCss(bominstanceRequest.getCss());
                    bominstance.setMinor_rev(bominstanceRequest.getMinor_rev());
                    bominstance.setManager_by_id(bominstanceRequest.getManager_by_id());

                    return bominstanceRepository.save(bominstance);
                }).orElseThrow(() -> new ResourceNotFoundException("bominstance not found with id " + bominstanceId));
    }


    @DeleteMapping("/bominstance/{bominstanceId}")
    public ResponseEntity<?> deleteBominstance(@PathVariable Long bominstanceId) {
        return bominstanceRepository.findById(bominstanceId)
                .map(bominstance -> {
                    bominstanceRepository.delete(bominstance);
                    return ResponseEntity.ok().build();
                }).orElseThrow(() -> new ResourceNotFoundException("bominstance not found with id " + bominstanceId));
    }
}

