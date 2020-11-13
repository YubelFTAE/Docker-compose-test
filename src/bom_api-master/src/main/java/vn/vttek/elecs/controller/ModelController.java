package vn.vttek.elecs.controller;

import java.util.Arrays;
import java.util.List;
import java.util.NoSuchElementException;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.data.domain.Sort.Direction;
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

import vn.vttek.elecs.entities.Model;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.ModelRepository;

@RestController
public class ModelController{
	    @Autowired
	    private ModelRepository modelRepository;

	    @GetMapping("/model")
	    public Page<Model> getModel(Pageable pageable) {
	    	return (Page<Model>) modelRepository.findAll(new Sort(Direction.DESC, new String[] {"id"}));
	    }


	    @PostMapping("/model")
	    public Model createModel(@Valid @RequestBody Model model) {
	        return modelRepository.save(model);
	    }

	    @PutMapping("/model/{modelId}")
	    public Model updateModel(@PathVariable Long modelId,
                                 @Valid @RequestBody Model modelRequest) {
	        return modelRepository.findById(modelId)
	                .map(model -> {
	                	model.setId_part_number(modelRequest.getId_part_number());
	                	model.setDescription(modelRequest.getDescription());
	                	model.setItem_number(modelRequest.getItem_number());
	                	model.setName(modelRequest.getName());
	                	model.setVersion_number(modelRequest.getVersion_number());
	                	model.setRelease_number(modelRequest.getRelease_number());
	                	model.setCreated_by_id(modelRequest.getCreated_by_id());
	                	model.setCreated_on(modelRequest.getCreated_on());
	                	model.setModified_by_id(modelRequest.getModified_by_id());
	                	model.setModified_on(modelRequest.getModified_on());
	                    return modelRepository.save(model);
	                }).orElseThrow(() -> new ResourceNotFoundException("model not found with id " + modelId));
	    }


	    @DeleteMapping("/model/{modelId}")
	    public ResponseEntity<?> deleteModel(@PathVariable Long modelId) {
	        return modelRepository.findById(modelId)
	                .map(model -> {
	                	modelRepository.delete(model);
	                    return ResponseEntity.ok().build();
	                }).orElseThrow(() -> new ResourceNotFoundException("model not found with id " + modelId));
	    }
	    
	    @RequestMapping(path = "/model/getListModel", method = RequestMethod.GET)
		public List<Model> getListModel(@RequestParam String id) {
			if (id == null || id.isEmpty()) {
				System.err.println("id mustn't null");
				return null;
			}
			if ("*".equals(id)) {
				return modelRepository.findAll(new Sort(Direction.DESC, new String[] {"id"}));
			} else {
				try {
					long longId = Long.parseLong(id);
					return Arrays.asList(new Model[] { modelRepository.findById(longId).get() });
				} catch (java.lang.NumberFormatException e) {
					System.err.println(e);
				} catch (Exception e) {
					System.err.println(e);
				}
				return null;
			}

		}

		@PostMapping("/model/addNewModel")
		public Boolean addNewModel(@Valid @RequestBody Model model) {
			if (model == null) {
				System.err.println("model mustn't null");
				return null;
			}
			try {
				return modelRepository.save(model) == null ? false : true;
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}
		
		@RequestMapping(path = "/model/checkModelCode", method = RequestMethod.GET)
		public Boolean checkModelCode(@RequestParam String moder) {
			if (moder == null || moder.isEmpty()) {
				System.err.println("id mustn't null");
				return null;
			}
			try {
				return modelRepository.countByItemNumber(moder) > 0L ? true : false;
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;

		}
	    
		@RequestMapping(path = "/model/getListModelByProId", method = RequestMethod.GET)
		public List<Model> getListModelByProId(@RequestParam Long pro_id) {
			if (pro_id == null) {
				System.err.println("id mustn't null");
				return null;
			}
			try {
				return modelRepository.getListModelByProId(pro_id);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
	
		}
		
    @PutMapping("/model/updateInfoModel/{mod_id}")
    public Model updateInfoModel(@PathVariable Long mod_id, @Valid @RequestBody Model model) {
	return modelRepository.findById(mod_id).map(m -> {
	    m.setId_part_number(model.getId_part_number());
	    m.setDescription(model.getDescription());
	    m.setItem_number(model.getItem_number());
	    m.setName(model.getName());
	    m.setVersion_number(model.getVersion_number());
	    m.setRelease_number(model.getRelease_number());
	    m.setCreated_by_id(model.getCreated_by_id());
	    m.setProduct_id(model.getProduct_id());
	    m.setCreated_on(model.getCreated_on());
    	m.setModified_by_id(model.getModified_by_id());
    	m.setModified_on(model.getModified_on());
	    return modelRepository.save(m);
	}).orElseThrow(() -> new ResourceNotFoundException("Model not found with id " + mod_id));
    }
		
		@PutMapping("/model/changePartOfModel/{mod_id}/{part_id}")
		public Boolean changePartOfModel(@PathVariable Long mod_id, @PathVariable Long part_id) {
			System.out.println(mod_id + "\t" + part_id);
			if (mod_id == null || part_id == null) {
				System.err.println("mod_id and part_id mustn't null");
				return null;
			}
			try {
				return modelRepository.changePartOfModel(part_id, mod_id) > 0L ? true : false;
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}
		
		@DeleteMapping("/model/deleteModel/{mod_id}")
		public ResponseEntity<?> deleteModel1(@PathVariable Long mod_id) {
			return modelRepository.findById(mod_id).map(model -> {
				modelRepository.delete(model);
				return ResponseEntity.ok().build();
			}).orElseThrow(() -> new ResourceNotFoundException("model not found with id " + mod_id));
		}
}
