package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import vn.vttek.elecs.entities.MgmtFunction;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.MgmtFunctionRepository;

import javax.validation.Valid;

@RestController
public class MgmtFunctionController {

    @Autowired
    private MgmtFunctionRepository mgmtfunctionRepository;

    @GetMapping("/mgmtfunction")
    public Page<MgmtFunction> getMgmtFunction(Pageable pageable) {
        return (Page<MgmtFunction>) mgmtfunctionRepository.findAll();
    }


    @PostMapping("/mgmtfunction")
    public MgmtFunction createMgmtFunction(@Valid @RequestBody MgmtFunction mgmtfunction) {
        return mgmtfunctionRepository.save(mgmtfunction);
    }

    @PutMapping("/mgmtfunction/{mgmtfunctionId}")
    public MgmtFunction updateMgmtFunction(@PathVariable Long mgmtfunctionId,
                                           @Valid @RequestBody MgmtFunction mgmtfunctionRequest) {
        return mgmtfunctionRepository.findById(mgmtfunctionId)
                .map(mgmtfunction -> {
                    mgmtfunction.setName(mgmtfunctionRequest.getName());
                    mgmtfunction.setRemark(mgmtfunctionRequest.getRemark());
                    mgmtfunction.setCreated_on(mgmtfunctionRequest.getCreated_on());
                    mgmtfunction.setState(mgmtfunctionRequest.getState());
                    return mgmtfunctionRepository.save(mgmtfunction);
                }).orElseThrow(() -> new ResourceNotFoundException("mgmtfunction not found with id " + mgmtfunctionId));
    }


    @DeleteMapping("/mgmtfunction/{mgmtfunctionId}")
    public ResponseEntity<?> deleteMgmtFunction(@PathVariable Long mgmtfunctionId) {
        return mgmtfunctionRepository.findById(mgmtfunctionId)
                .map(mgmtfunction -> {
                    mgmtfunctionRepository.delete(mgmtfunction);
                    return ResponseEntity.ok().build();
                }).orElseThrow(() -> new ResourceNotFoundException("mgmtfunction not found with id " + mgmtfunctionId));
    }
}

