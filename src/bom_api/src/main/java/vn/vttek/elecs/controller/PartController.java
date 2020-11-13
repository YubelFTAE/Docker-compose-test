package vn.vttek.elecs.controller;

import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.math.BigInteger;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Base64;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.NoSuchElementException;
import java.util.Set;
import java.util.Stack;

import javax.persistence.EntityManager;
import javax.validation.Valid;

import org.apache.commons.collections4.map.HashedMap;
import org.hibernate.Session;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.io.InputStreamResource;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.data.domain.Sort.Direction;
import org.springframework.http.HttpHeaders;
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

import vn.vttek.elecs.entities.Part;
import vn.vttek.elecs.entities.PartAlternate;
import vn.vttek.elecs.entities.PartBom;
import vn.vttek.elecs.entities.PartBuy;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.PartAlternateRepository;
import vn.vttek.elecs.repository.PartBomRepository;
import vn.vttek.elecs.repository.PartBuyRepository;
import vn.vttek.elecs.repository.PartRepository;
import vn.vttek.elecs.util.ExcelGenerator;
import vn.vttek.elecs.util.Utils;

@RestController
public class PartController {

    @Autowired
    private PartRepository partRepository;
    
    @Autowired
    private PartBomRepository partbomRepository;
    
    @Autowired
    private PartBuyRepository partBuyRepository;
    
    @Autowired
    private ManufacturerController manufacturerController;
    
    @Autowired
    private EntityManager entityManager;

    @Autowired
    private PartAlternateRepository partAlternateRepository;

    @GetMapping("/part")
    public Iterable<Part> getQuestions(Pageable pageable) {
        return partRepository.findAll(new Sort(Direction.DESC, new String[] {"id"}));
    }


    @PostMapping("/part")
    public Part createPart(@Valid @RequestBody Part part) {
        return partRepository.save(part);
    }

    @PutMapping("/part/{partId}")
    public Part updatePart(@PathVariable Long partId,
                           @Valid @RequestBody Part partRequest) {
        return partRepository.findById(partId)
                .map(part -> {
                    part.setItem_number(partRequest.getItem_number());
                    part.setName(partRequest.getName());
                    part.setDescription(partRequest.getDescription());
                    part.setCategory(partRequest.getCategory());
                    part.setManufacturer(partRequest.getManufacturer());
                    part.setNumber_manufacturer_res(partRequest.getNumber_manufacturer_res());
                    part.setLead_time(partRequest.getLead_time());
                    part.setClassification(partRequest.getClassification());
                    part.setState(partRequest.getState());
                    part.setCurrent_state(partRequest.getCurrent_state());
                    part.setVersion(partRequest.getVersion());
                    part.setCost(partRequest.getCost());
                    part.setMake_by(partRequest.getMake_by());
                    part.setUnit(partRequest.getUnit());
                    part.setWeight(partRequest.getWeight());
                    part.setThumbnail(partRequest.getThumbnail());
                    part.setCreated_by_id(partRequest.getCreated_by_id());
                    part.setCreated_on(partRequest.getCreated_on());
                    part.setModified_by_id(partRequest.getModified_by_id());
                    part.setModified_on(partRequest.getModified_on());
                    part.setLocked_by_id(partRequest.getLocked_by_id());
                    part.setNot_lockable(partRequest.getNot_lockable());
                    part.setConfig_id(partRequest.getConfig_id());
                    part.setGeneration(partRequest.getGeneration());
                    part.setRelease_date(partRequest.getRelease_date());
                    part.setEffective_date(partRequest.getEffective_date());
                    part.setIs_released(partRequest.getIs_released());
                    part.setIs_current(partRequest.getIs_current());
                    part.setMajor_rev(partRequest.getMajor_rev());
                    part.setHas_change_pending(partRequest.getHas_change_pending());
                    part.setPermission_id(partRequest.getPermission_id());
                    part.setExternal_type(partRequest.getExternal_type());
                    part.setQuantity(partRequest.getQuantity());
                    part.setSort_order(partRequest.getSort_order());
                    part.setReference_designator(partRequest.getReference_designator());
                    part.setManufacturer_id(partRequest.getManufacturer_id());
                    part.setVersion(partRequest.getVersion());
                    part.setVendorId(partRequest.getVendorId());
                    part.setActive(partRequest.getActive());
                    part.setVietelCode(partRequest.getVietelCode());

                    return partRepository.save(part);
                }).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + partId));
    }


    @DeleteMapping("/part/{partId}")
    public ResponseEntity<?> deletePart(@PathVariable Long partId) {
        return partRepository.findById(partId)
                .map(part -> {
                    partRepository.delete(part);
                    return ResponseEntity.ok().build();
                }).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + partId));
    }
    
    @RequestMapping(path = "/part/getListParts", method = RequestMethod.GET)
	public List<Part> getListParts(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			return partRepository.findAll(new Sort(Direction.DESC, new String[] {"id"}));
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Part[] { partRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				e.printStackTrace();
				System.err.println(e);
			} catch (Exception e) {
				e.printStackTrace();
				System.err.println(e);
			}
			return null;
		}

	}

	@PostMapping("/part/addNewPart")
	public Boolean addNewPart(@Valid @RequestBody Part part) {
		if (part == null) {
			System.err.println("part mustn't null");
			return null;
		}
		try {
			Part ret = partRepository.save(part);
			ret.setConfig_id(ret.getId());
			return partRepository.save(ret) == null ? false : true;
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;
	}
    
	@RequestMapping(path = "/part/checkPartCode", method = RequestMethod.GET)
	public Boolean checkPartCode(@RequestParam String part_number) {
		if (part_number == null || part_number.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			return partRepository.countByItemNumber(part_number) > 0L ? true : false;
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;

	}
	
    @RequestMapping(path = "/part/getInfoPartByModelId", method = RequestMethod.GET)
	public List<Part> getInfoPartByModelId(@RequestParam Long mod_id) {
		if (mod_id == null) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			return partRepository.getInfoPartByModelId(mod_id);
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;

	}
    
    @DeleteMapping("/part/deletePart/{part_id}")
	public ResponseEntity<?> deletePart1(@PathVariable Long part_id) {
		return partRepository.findById(part_id).map(part -> {
			partRepository.delete(part);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("model not found with id " + part_id));
	}
    
    @RequestMapping(path = "/part/getPartNumberById", method = RequestMethod.GET)
	public String getPartNumberById(@RequestParam Long part_id) {
		if (part_id == null) {
			System.err.println("part_id mustn't null");
			return null;
		}
		try {
			return partRepository.getPartNumberById(part_id);
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;
	}
    
    @RequestMapping(path = "/part/getListPartRelationShip", method = RequestMethod.GET)
	public List<?> getListPartRelationShip(@RequestParam Long part_id, @RequestParam Short type) {
		if (part_id == null || type == null) {
			System.err.println("part_id and type mustn't null");
			return null;
		}
		try {
			if (type.longValue() == 0) {
				return partRepository.getPartBom(part_id);
			} else if (type.longValue() == 1) {
				return partRepository.getPartAltenative(part_id);
			} else if (type.longValue() == 2) {
				return partRepository.getPartBuy(part_id);
			} else {
				throw new RuntimeException("Not exist type " + type);
			}
			
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;
	}
    
    @PutMapping("/part/updateGenerationPart/{part_id}")
	public Part updateGenerationPart(@PathVariable Long part_id) {
    	return partRepository.findById(part_id)
                .map(part -> {
                    part.setGeneration(part.getGeneration() == null ? 1 : part.getGeneration() + 1);

                    return partRepository.save(part);
                }).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + part_id));
	}
    
    @PutMapping("/part/updateGeneration/{part_id}")
	public Part updateGeneration(@PathVariable Long part_id) {
    	return partRepository.findById(part_id)
                .map(part -> {
                    part.setGeneration(part.getGeneration() == null ? 1 : part.getGeneration() + 1);

                    return partRepository.save(part);
                }).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + part_id));
	}
    
    @PostMapping("/part/addPartRelationShip/{part_id}/{type}")
	public Boolean addPartRelationShip(@PathVariable Long part_id, @PathVariable Long type, @Valid @RequestBody List<Long> ids) {
    	if (part_id == null || type == null || ids == null) {
			System.err.println("part_id and type mustn't null");
			return null;
		}
    	ids.removeAll(Arrays.asList(new Long[] {part_id}));
		try {
			if (type.longValue() == 0) {
				List<PartBom> boms = new ArrayList<PartBom>();
				ids.forEach(id -> {
					PartBom bom = new PartBom();
					bom.setRelated_id(id);
					bom.setSource_id(part_id);
					bom.setClassification("classification");
					boms.add(bom);
				});
				return partbomRepository.saveAll(boms).size() == boms.size() ? true : false;
			} else if (type.longValue() == 1) {
				List<PartAlternate> alternates = new ArrayList<PartAlternate>();
				ids.forEach(id -> {
					PartAlternate alternate = new PartAlternate();
					alternate.setRelated_id(id);
					alternate.setSource_id(part_id);
					alternate.setClassification("classification");
					alternates.add(alternate);
				});
				return partAlternateRepository.saveAll(alternates).size() == alternates.size() ? true : false;
			} else if (type.longValue() == 2) {
				List<PartBuy> buyes = new ArrayList<PartBuy>();
				ids.forEach(id -> {
					PartBuy buy = new PartBuy();
					buy.setRelated_id(id);
					buy.setSource_id(part_id);
					buy.setClassification("classification");
					buyes.add(buy);
				});
				return partBuyRepository.saveAll(buyes).size() == buyes.size() ? true : false;
			} else {
				throw new RuntimeException("Not exist type " + type);
			}
			
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;
	}
    
    @PostMapping("/part/addPartFromFile/{part_id}/{created_by_id}")
	public Boolean addPartFromFile(@PathVariable Long part_id, @PathVariable Long created_by_id, @Valid @RequestBody String based64) {
    	if (part_id == null || created_by_id == null) {
			System.err.println("part_id and create_by_id mustn't null");
			return null;
		}
		InputStream stream = new ByteArrayInputStream(Base64.getDecoder().decode(based64.getBytes()));
		List<Part> parts;
		List<PartBom> boms = new ArrayList<PartBom>();
		List<PartAlternate> alternates = new ArrayList<PartAlternate>();
		try {
			// set of item_number from file
			Set<String> itemNumber = new HashSet<>();
			// key: item_number, value: part_id 
			Map<String, Long> mapExistedPart = new HashMap<String, Long>();
			// list existed part in database
			Set<Long> existedPart = new HashSet<>();
			parts = Utils.readRawBom(stream, part_id, created_by_id, itemNumber);
			if (!itemNumber.isEmpty()) {
				@SuppressWarnings("unchecked")
				List<Object[]> idItemNumber = entityManager.createNativeQuery("SELECT id, item_number FROM part WHERE item_number IN :items")
								.setParameter("items", itemNumber)
								.getResultList();
				for (Object[] objs : idItemNumber) {
					if (objs[1] == null) {
						continue;
					}
					mapExistedPart.put((String) objs[1], ((BigInteger) objs[0]).longValue());
					existedPart.add(((BigInteger) objs[0]).longValue());
				}
			}
//			parts.forEach(part -> {
//				
//			});
			// blacklist of part insert
			Set<Long> blacklist = blacklist(part_id);
			// key: partId, value: Children of partId
			Map<Long, Set<Long>> children = allChildren(existedPart);
			boolean isLoop = false;
			for (Part part : parts) {
				String item = part.getItem_number();
				if (!mapExistedPart.containsKey(item)) { // is not exist generate id and add add exist 
					mapExistedPart.put(item, partRepository.save(part).getId());
					part.setManufacturer_id((manufacturerController.getOrCreateManuByName(part.getManufacturer(), created_by_id.intValue())).getId());
				}
				part.setId(mapExistedPart.get(item));
				
				int offset = part.getOffsetManufacturer();
				if (offset == 1) {
					if (isLoop = isLoop(blacklist, children, part.getId())) {
						System.err.println("Loop part_id = " + part.getId());
						continue;
					}
					
					PartBom bom = new PartBom();
					bom.setQuantity(part.getQuantity());
					bom.setRelated_id(part.getId());
					bom.setConfig_id(part.getId());
					bom.setSource_id(part_id);
					bom.setCreated_by_id(created_by_id);
					bom.setCreated_on(new Timestamp(System.currentTimeMillis()));
					bom.setClassification(part.getClassification());
					boms.add(bom);
				} else if (offset == 2 || offset == 3) {
					if (isLoop)
						continue;
					PartAlternate alter = new PartAlternate();
					alter.setRelated_id(part.getId());
					alter.setConfig_id(part.getId());
					alter.setSource_id(boms.get(boms.size() - 1).getRelated_id());
					alter.setCreated_by_id(created_by_id);
					alter.setCreated_on(new Timestamp(System.currentTimeMillis()));
					alter.setClassification(part.getClassification());
					alternates.add(alter);
				} else {
					throw new RuntimeException("Don't exist offset: " + offset);
				}
			}
			return partbomRepository.saveAll(boms).size() == boms.size() && partAlternateRepository.saveAll(alternates).size() == alternates.size() ? true : false;
//			return true;
		} catch (IOException e) {
			e.printStackTrace();
		}
		return false;
	}
    
    @RequestMapping(path = "/part/getStructBomById", method = RequestMethod.GET)
	public String getStructBomById(@RequestParam Long part_id) {
		if (part_id == null) {
			System.err.println("part_id mustn't null");
			return null;
		}
		try {
			Set<Long> ids = new HashSet<Long>();
			Set<PartController.Relation> allRelations = allRelations(Arrays.asList(part_id), ids);
//			if (checkLoopTree(allRelations, part_id)) {
//				return "tree loop: part_id " + part_id;
//			}
			Map<Long, Part> parts = getParts(ids);
			return Utils.toJson(buildTree(parts, allRelations, part_id));
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;
	}

	private boolean isLoop(Set<Long> blacklist, Map<Long, Set<Long>> children, Long id) {
		if (blacklist.contains(id)) {
			return true;
		}
		blacklist.add(id);
		Set<Long> childrenOfId = children.get(id);
		if (childrenOfId == null) {
			return false;
		}
		Set<Long> copyBlacklist = new HashSet<>(blacklist);
		if (copyBlacklist.retainAll(childrenOfId))
			return true;
		return false;
	}

	private Set<PartController.Relation> allRelations(List<Long> partIds, Set<Long> ids) {
		StringBuilder sb = new StringBuilder();
		sb.append("WITH RECURSIVE ");
		sb.append("	cte(id, path, source_id, related_id) AS ( ");
		sb.append(
				"		SELECT id, CONCAT(CAST (source_id AS TEXT), '->', CAST (related_id AS text)), source_id, related_id ");
		sb.append("		FROM part_bom ");
		sb.append("		WHERE source_id IN (:sourceId) ");
		sb.append("	UNION ALL ");
		sb.append("		SELECT pb.id, CONCAT(CAST (path AS text), '->', pb.related_id), pb.source_id, pb.related_id ");
		sb.append("		FROM part_bom pb ");
		sb.append("		JOIN cte n ON n.related_id = pb.source_id ");
		sb.append("	) ");
//		sb.append("	), ");
//		sb.append(" cte1(id, path, source_id, related_id) AS ( ");
//		sb.append("		SELECT id, CONCAT(CAST (related_id AS text), '->', CAST (source_id AS text)), source_id, related_id ");
//		sb.append("		FROM part_bom ");
//		sb.append("		WHERE related_id in (:sourceId) ");
//		sb.append("	UNION ALL ");
//		sb.append("		SELECT pb.id, CONCAT(CAST (path AS text), '->', pb.source_id), pb.source_id, pb.related_id ");
//		sb.append("		FROM part_bom pb ");
//		sb.append("		JOIN cte1 n ON n.source_id = pb.related_id ");
//		sb.append("	) ");
		sb.append("SELECT DISTINCT 'bom' AS t, source_id, related_id, path FROM cte ");
//		sb.append("UNION ALL ");
//		sb.append("SELECT DISTINCT 'bom1' AS t, source_id, related_id, path FROM cte1 ");
		sb.append("ORDER BY t desc, source_id, related_id ");
		System.out.println(sb.toString());
		@SuppressWarnings("unchecked")
		List<Object[]> struct = entityManager.createNativeQuery(sb.toString())
				.setParameter("sourceId", partIds)
				.getResultList();
		ids.addAll(partIds);
		Set<PartController.Relation> allRelations = new HashSet<PartController.Relation>();
		for (Object[] objs : struct) {
			if (objs[0] == null || objs[1] == null || objs[2] == null)
				continue;
			ids.add(((BigInteger) objs[1]).longValue());
			ids.add(((BigInteger) objs[2]).longValue());
			PartController.Relation rel = new Relation();
			rel.sourceId = ((BigInteger) objs[1]).longValue();
			rel.relatedId = ((BigInteger) objs[2]).longValue();
			allRelations.add(rel);
		}
		return allRelations;
	}
	
	private Map<Long, Set<Long>> allChildren(Set<Long> partIds) {
		if (partIds == null || partIds.isEmpty()) {
			return new HashMap<>();
		}
		// Long: partId, Set: children of partId
		Map<Long, Set<Long>> ret = new HashMap<Long, Set<Long>>();
		StringBuilder sb = new StringBuilder();
		sb.append("with recursive  ").append("\r\n");
		sb.append("	cte(id, path, source_id, related_id) as ( ").append("\r\n");
		sb.append("		select id, concat(cast (source_id as text), '->', cast (related_id as text)), source_id, related_id ").append("\r\n");
		sb.append("		from part_bom ").append("\r\n");
		sb.append("		where source_id in :partIds ").append("\r\n");
		sb.append("	union all ").append("\r\n");
		sb.append("		select pb.id, concat(cast (path as text), '->', pb.related_id), pb.source_id, pb.related_id ").append("\r\n");
		sb.append("		from part_bom pb ").append("\r\n");
		sb.append("		join cte n on n.related_id = pb.source_id ").append("\r\n");
		sb.append("	) ").append("\r\n");
		sb.append("select distinct 'bom' as t, path, source_id, related_id, cast(split_part(path, '->', 1) as bigint) root from cte ").append("\r\n");
		sb.append("order by t desc, path, source_id, related_id; ").append("\r\n");
		System.out.println(sb.toString());
		@SuppressWarnings("unchecked")
		List<Object[]> struct = entityManager.createNativeQuery(sb.toString())
				.setParameter("partIds", partIds)
				.getResultList();
		for (Object[] objs : struct) {
			if (objs[2] == null || objs[3] == null || objs[4] == null)
				continue;
			Long root = ((BigInteger) objs[4]).longValue();
			Long sourceId = ((BigInteger) objs[2]).longValue();
			Long relatedId = ((BigInteger) objs[3]).longValue();
			Set<Long> children = null;
			if (ret.containsKey(root)){
				children = ret.get(root);
			} else {
				children = new HashSet<>();
			}
			children.add(sourceId);
			children.add(relatedId);
			ret.put(root, children);
		}
		return ret;
	}
	
	private Set<Long> blacklist(Long partId) {
		Set<Long> parentAndChilren = new HashSet<>();
		StringBuilder sb = new StringBuilder();
		sb.append("with recursive  ");
		sb.append("	cte(id, path, source_id, related_id) as ( ");
		sb.append("		select id, concat(cast (related_id as text), '->', cast (source_id as text)), source_id, related_id ");
		sb.append("		from part_bom ");
		sb.append("		where related_id = :partId ");
		sb.append("	union all ");
		sb.append("		select pb.id, concat(cast (path as text), '->', pb.source_id), pb.source_id, pb.related_id ");
		sb.append("		from part_bom pb ");
		sb.append("		join cte n on n.source_id = pb.related_id ");
		sb.append("	) ");
		sb.append("select distinct 'parent' as t, path, source_id, related_id from cte ");
		sb.append("union all ");
		sb.append("select distinct 'children' as t, concat(cast (source_id as text), '->', cast (related_id as text)) path, source_id, related_id from part_bom where source_id = :partId ");
		sb.append("order by t desc, path, source_id, related_id ");
		@SuppressWarnings("unchecked")
		List<Object[]> struct = entityManager.createNativeQuery(sb.toString())
				.setParameter("partId", partId)
				.getResultList();
		for (Object[] objs : struct) {
			if (objs[2] == null || objs[3] == null)
				continue;
			parentAndChilren.add(((BigInteger) objs[2]).longValue());
			parentAndChilren.add(((BigInteger) objs[3]).longValue());
		}
		return parentAndChilren;
	}

    private Map<Long, Part> getParts(Set<Long> ids) {
    	StringBuilder sb = new StringBuilder();
		sb.append("FROM Part WHERE id IN :ids ");
		Map<Long, Part> map = new HashedMap<Long, Part>();
		@SuppressWarnings("unchecked")
		List<Part> parts = entityManager.createQuery(sb.toString()).setParameter("ids", ids).getResultList();
		parts.forEach(part -> {
			map.put(part.getId(), part);
		});
		return map;
    }

	private Part buildTree(Map<Long, Part> parts, Set<PartController.Relation> allRelations, Long rootId) {
		Part tree = parts.get(rootId);
		Stack<Part> stack = new Stack<>();
		stack.push(tree);
		while (!stack.isEmpty()) {
			Part parent = stack.pop();
//    		System.out.println(parent.getId());
			List<Part> children = findBySourceId(parts, allRelations, parent.getId());
			parent.getChildren().addAll(children);
			stack.addAll(children);
		}
		return tree;
	}

	private List<Part> findBySourceId(Map<Long, Part> parts, Set<PartController.Relation> allRelations, Long sourceId) {
		List<Part> ret = new ArrayList<Part>();
		int level = parts.get(sourceId).getLevel() + 1;
		allRelations.forEach(relation -> {
//    		System.out.println(relation.sourceId + "\t" + sourceId);
			if (relation.sourceId.equals(sourceId)) {
				Part part = parts.get(relation.relatedId);
				part.setLevel(level);
				ret.add(part);
			}
		});
		return ret;
	}

    @PutMapping("/part/updatePart/{part_id}")
    public Boolean updatePart1(@PathVariable Long part_id,
                             @Valid @RequestBody Part part) {
		if (part_id == null || part == null) {
			System.err.println("part_id and part mustn't null");
			return null;
		}
		Part p;
		try {
			p = partRepository.findById(part_id).get();
		} catch (NoSuchElementException e) {
			e.printStackTrace();
			System.err.println("cann't found mod_id: " + part_id);
			return null;
		}
		p.setAdjust_quantity(part.getAdjust_quantity());
		p.setCategory(part.getCategory());
		p.setClassification(part.getClassification());
		p.setCost(part.getCost());
//		p.setCost_basis(part.getCost_basis());
		p.setCreated_by_id(part.getCreated_by_id());
		p.setCurrent_state(part.getCurrent_state());
		p.setDescription(part.getDescription());
		p.setEffective_date(part.getEffective_date());
		p.setExternal_type(part.getExternal_type());
		p.setHas_change_pending(part.getHas_change_pending());
		p.setIs_current(part.getIs_current());
		p.setIs_released(part.getIs_released());
		p.setIs_sure(part.getIs_sure());
		p.setItem_number(part.getItem_number());
		p.setLead_time(part.getLead_time());
		p.setLocked_by_id(part.getLocked_by_id());
		p.setMajor_rev(part.getMajor_rev());
		p.setMake_by(part.getMake_by());
		p.setManufacturer(part.getManufacturer());
		p.setModified_by_id(part.getModified_by_id());
		p.setModified_on(new Timestamp(System.currentTimeMillis()));
		p.setName(part.getName());
		p.setNot_lockable(part.getNot_lockable());
		p.setNote(part.getNote());
		p.setNumber_manufacturer_res(part.getNumber_manufacturer_res());
		p.setPacking(part.getPacking());
		p.setPermission_id(part.getPermission_id());
		p.setQuantity(part.getQuantity());
		p.setReference_designator(part.getReference_designator());
		p.setRelease_date(part.getRelease_date());
		p.setSort_order(part.getSort_order());
		p.setState(part.getState());
		p.setThumbnail(part.getThumbnail());
		p.setUnit(part.getUnit());
		p.setVersion(part.getVersion());
		p.setWeight(part.getWeight());
		p.setManufacturer_id(part.getManufacturer_id());
		p.setVendorId(part.getVendorId());
		p.setActive(part.getActive());
		p.setVietelCode(part.getVietelCode());
    	return partRepository.save(p) == null ? false : true;
    }
    
    ///part/deletePartRelationShip/1/PART_BOM/
//    @PutMapping("/part/deletePartRelationShip/{part_id}/{type}")
//    public Boolean deletePartRelationShip(@PathVariable Long part_id, @PathVariable Long type) {
//		if (part_id == null || type == null) {
//			System.err.println("mod_id and type mustn't null");
//			return null;
//		}
//		Part p;
//		try {
//			p = partRepository.findById(part_id).get();
//		} catch (NoSuchElementException e) {
//			e.printStackTrace();
//			System.err.println("cann't found mod_id: " + part_id);
//			return null;
//		}
//    	return partRepository.save(p) == null ? false : true;
//    }
    
    static class Relation{
    	Long sourceId;
    	Long relatedId;
		@Override
		public String toString() {
			return "Relation [sourceId=" + sourceId + ", relatedId="
					+ relatedId + "]";
		}
	}

    @RequestMapping(path = "/part/getPartOfManu", method = RequestMethod.GET)
    public List<Part> getPartOfManu(@RequestParam Long manu_id) {
	if (manu_id == null) {
	    System.err.println("manu_id mustn't null");
	    return null;
	}
	try {
	    List<Part> parts = partRepository.findPartOfManu(manu_id);
	    return parts;
	} catch (Exception e) {
	    e.printStackTrace();
	    System.err.println(e);
	}
	return null;

    }

	@GetMapping("/part/download/{partId}")
	public ResponseEntity<InputStreamResource> downloadExcell(@PathVariable Long partId) {
		try {
			List<Long> ids = new ArrayList<Long>();
			getPartBomTree(partId, ids);
			List<Part> parts = partRepository.findAllById(ids);

			String array[][] = new String[parts.size() + 2][Utils.PART_BOM_COLUMN.length];
			for (int i = 0; i < Utils.PART_BOM_COLUMN.length; i++) {
				array[0][i] = Utils.PART_BOM_COLUMN[i];
				array[1][i] = String.valueOf(i + 1);
			}

			for (int i = 2; i < parts.size() + 2; i++) {
				Part part = parts.get(i - 2);
				int colIdx = 0;

				array[i][colIdx++] = String.valueOf(i - 1);
				array[i][colIdx++] = part.getDescription();
				array[i][colIdx++] = part.getCategory();
				array[i][colIdx++] = part.getExternal_type();
				array[i][colIdx++] = part.getManufacturer();
				array[i][colIdx++] = part.getItem_number();

				List<Long> partIds = partAlternateRepository.findRelatedIdByPartId(part.getId());
				List<Part> partAlternate = partRepository.findAllById(partIds);

				for (int k = 0; k < 2; k++) {
					Part p = partAlternate.size() > k ? partAlternate.get(k) : null;
					array[i][colIdx++] = p != null ? p.getManufacturer() : "";
					array[i][colIdx++] = p != null ? p.getItem_number() : "";
				}

				array[i][colIdx++] = String.valueOf(part.getQuantity());
				array[i][colIdx++] = part.getUnit();
				array[i][colIdx++] = part.getReference_designator();
				array[i][colIdx++] = String.valueOf(part.getCost());
				array[i][colIdx++] = String.valueOf(part.getNumber_manufacturer_res());
				array[i][colIdx++] = "";
			}

			ByteArrayInputStream in = ExcelGenerator.customersToExcel(array, Utils.PART_BOM_HEADER);
			// return IOUtils.toByteArray(in);

			HttpHeaders headers = new HttpHeaders();
			headers.add("Content-Disposition", "attachment; filename=parts.xlsx");

			return ResponseEntity.ok().headers(headers).body(new InputStreamResource(in));
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return null;
	}

//    @PostMapping("/part/updateVersionPart/{part_id}/{type}")
//    public Boolean updateVersionPart(@PathVariable Long part_id, @PathVariable Long type) {
    @PostMapping("/part/updateVersionPart/{part_id}")
    public Boolean updateVersionPart(@PathVariable Long part_id) {
		List<?> partFiles = entityManager.createNativeQuery("select file_id from part_files where part_id = :partId")
		.setParameter("partId", part_id).getResultList();
    	Part part = partRepository.findById(part_id).map(p -> {
    		entityManager.detach(p);
    		p.setConfig_id(p.getConfig_id() == null ? p.getId() : p.getConfig_id());
    		p.setId(null);
    		p.setVersion(partRepository.findMaxVersionByItemNumber(p.getItem_number()) + 1);
    		return partRepository.save(p);
    	}).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + part_id));
    	
    	try {
			List<PartBom> boms = new ArrayList<>();
			partbomRepository.getListPartBomBySourceId(part_id).forEach(bom -> {
				entityManager.detach(bom);
				bom.setId(null);
				bom.setSource_id(part.getId());
				boms.add(bom);
			});
			List<PartAlternate> alternates = new ArrayList<>();
			partAlternateRepository.getListPartAlternateBySourceId(part_id).forEach(alternate -> {
				entityManager.detach(alternate);
				alternate.setId(null);
				alternate.setSource_id(part.getId());
				alternates.add(alternate);
			});
			List<PartBuy> instances = new ArrayList<>();
			partBuyRepository.getListPartBuyBySourceId(part_id).forEach(instance -> {
				entityManager.detach(instance);
				instance.setId(null);
				instance.setSource_id(part.getId());
				instances.add(instance);
			});
//			List<PartBuy> instances = new ArrayList<>();
//			partBuyRepository.getListPartBuyBySourceId(part_id).forEach(instance -> {
//				entityManager.detach(instance);
//				instance.setId(null);
//				instance.setSource_id(part.getId());
//				instances.add(instance);
//			});
			Session ss = null;
			try { 
				for (Object partId : partFiles) {
					ss = entityManager.unwrap(Session.class);
					ss.beginTransaction();
					ss.createNativeQuery("INSERT INTO part_files values (:partId, :fileId)")
							.setParameter("partId", part_id).setParameter("fileId", partId).executeUpdate();
					ss.getTransaction().commit();
				}
			} catch (Exception e) {
				e.printStackTrace();
			} 
//			finally {
//				if (ss != null) {
//					ss.close();
//				}
//			}
			return partBuyRepository.saveAll(instances).size() == instances.size() && 
					partbomRepository.saveAll(boms).size() == boms.size() && 
					partAlternateRepository.saveAll(alternates).size() == alternates.size()
					? true : false;
			
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
    	return null;
	}

	@GetMapping("/part/downloadRoleUpTree/{partId}")
	public ResponseEntity<InputStreamResource> downloadRoleUpTree(@PathVariable Long partId) {
		try {
			Part partParent = partRepository.findById(partId).get();
			List<Part> parts = new ArrayList<Part>();
			getPartTree(partParent, parts);

			String array1[][] = Utils.ROLE_UP_TREE_ROW;
			array1[0][1] = partParent.getItem_number();
			array1[1][1] = partParent.getName();
			array1[2][1] = partParent.getQuantity() != null ? String.valueOf(partParent.getQuantity()) : "";

			String array[][] = new String[parts.size() + 1][Utils.ROLE_UP_TREE_COLUMN.length];
			for (int i = 0; i < Utils.ROLE_UP_TREE_COLUMN.length; i++) {
				array[0][i] = Utils.ROLE_UP_TREE_COLUMN[i];
			}

			for (int i = 1; i < parts.size() + 1; i++) {
				Part part = parts.get(i - 1);
				int colIdx = 0;
				array[i][colIdx++] = part.getItem_number();
				array[i][colIdx++] = part.getName();
				array[i][colIdx++] = part.getQuantity() != null ? String.valueOf(part.getQuantity()) : "";
				array[i][colIdx++] = part.getCost() != null ? String.valueOf(part.getCost()) : "";
				array[i][colIdx++] = (part.getQuantity() != null && part.getCost() != null)
						? String.valueOf(part.getQuantity() * part.getCost())
						: "";
			}

			ByteArrayInputStream in = ExcelGenerator.customersToExcel(array, array1);

			HttpHeaders headers = new HttpHeaders();
			headers.add("Content-Disposition", "attachment; filename=roleUpTree.xlsx");

			return ResponseEntity.ok().headers(headers).body(new InputStreamResource(in));
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	private void getPartBomTree(Long partId, List<Long> listPartIds) {
		List<Long> relatedIds = partbomRepository.findRelatedIdByPartId(partId);

		for (Long id : relatedIds) {
			listPartIds.add(id);
			getPartBomTree(id, listPartIds);
		}
	}

	private void getPartTree(Part part, List<Part> listPart) {
		List<Long> relatedIds = partbomRepository.findRelatedIdByPartId(part.getId());

		for (Long id : relatedIds) {
			Part p = partRepository.findById(id).get();
			p.setQuantity(
					part.getQuantity() != null && p.getQuantity() != null ? part.getQuantity() * p.getQuantity() : 0);
			listPart.add(p);
			System.out.println(id);
			getPartTree(p, listPart);
		}
	}

	@DeleteMapping("/part/deletePartRelationShip/{partId}/{type}")
	public Boolean deletePartRelationShip(@PathVariable Long partId, @PathVariable Long type,
			@Valid @RequestBody List<Long> ids) {
		if (partId == null) {
			System.err.println("part_id mustn't null");
			return false;
		}
		try {
			if (type.longValue() == 0) {
				List<PartBom> boms = partbomRepository.getListPartBom(partId, ids);
				partbomRepository.deleteAll(boms);
				return true;
			} else if (type.longValue() == 1) {
				List<PartAlternate> alternates = partAlternateRepository.getListPartAlternate(partId, ids);
				partAlternateRepository.deleteAll(alternates);
				return true;
			} else if (type.longValue() == 2) {
				List<PartBuy> buys = partBuyRepository.getListPartBuy(partId, ids);
				partBuyRepository.deleteAll(buys);
				return true;
			} else {
				throw new RuntimeException("Not exist type " + type);
			}
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e);
		}
		return false;
	}

	@GetMapping("/part/getVersionOfPart")
	public List<Part> addFileForPart(@RequestParam Long part_id) {
		return partRepository.findById(part_id).map(part -> {
			List<Part> parts = partRepository.findPartByItemNumber(part.getItem_number());
			return parts;
		}).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + part_id));
	}
	
	@PutMapping("/part/updateQuantity")
	public Part updateQuantity(@RequestParam Long part_id, @RequestParam Long quantity) {
		return partRepository.findById(part_id).map(part -> {
			part.setQuantity(quantity);
			return partRepository.save(part);
		}).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + part_id));
	}
}

