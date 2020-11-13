package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Sort;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import vn.vttek.elecs.entities.Department;
import vn.vttek.elecs.entities.Document;
import vn.vttek.elecs.entities.File;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.DocumentRepository;

import javax.validation.Valid;
import java.awt.print.Pageable;
import java.util.Arrays;
import java.util.Collections;
import java.util.List;
import java.util.Set;

@RestController
@RequestMapping("/document")
public class DocumentController {
	@Autowired
	private DocumentRepository documentRepository;

	@GetMapping("/getDocumentPage")
	public Page<Document> getDocumentPage(Pageable pageable) {
		return (Page<Document>) documentRepository.findAll();
	}

	@PostMapping("/addNewDocument")
	public ResponseEntity<String> createDocument(@Valid @RequestBody Document document) {
		if (documentRepository.existsByName(document.getName())) {
			return new ResponseEntity<String>("NAME_EXISTED", HttpStatus.BAD_REQUEST);
		}
		documentRepository.save(document);
		return ResponseEntity.ok().body("Create document successfully!");
	}

	@PutMapping("/updateDocment/{documentId}")
	public Document updateDocument(@PathVariable Long documentId, @Valid @RequestBody Document documentRequest) {
		return documentRepository.findById(documentId).map(document -> {
			document.setItem_number(documentRequest.getItem_number());
			document.setModified_on(documentRequest.getModified_on());
			document.setName(documentRequest.getName());
			document.setDescription(documentRequest.getDescription());
			document.setModified_on(documentRequest.getModified_on());
			document.setModified_by_id(documentRequest.getModified_by_id());
			document.setCurrent_state(documentRequest.getCurrent_state());
			document.setLocked_by_id(documentRequest.getLocked_by_id());
			document.setIs_current(documentRequest.getIs_current());
			document.setMinor_rev(documentRequest.getMinor_rev());
			document.setNot_lockable(documentRequest.getNot_lockable());
			document.setIs_release(documentRequest.getIs_release());
			document.setGeneration(documentRequest.getGeneration());
			document.setNew_version(documentRequest.getNew_version());
			document.setConfig_id(documentRequest.getConfig_id());
			document.setPermission_id(documentRequest.getPermission_id());
			document.setEffected_date(documentRequest.getEffected_date());
			document.setRelated_date(documentRequest.getRelated_date());
			document.setAuthoring_tool(documentRequest.getAuthoring_tool());
			document.setAuthoring_tool_version(documentRequest.getAuthoring_tool_version());
			document.setHas_files(documentRequest.getHas_files());
			return documentRepository.save(document);
		}).orElseThrow(() -> new ResourceNotFoundException("document not found with id " + documentId));
	}

	@DeleteMapping("/deleteDocument/{documentId}")
	public ResponseEntity<?> deleteDocument(@PathVariable Long documentId) {
		return documentRepository.findById(documentId).map(document -> {
			if (document.getFiles() != null) {
				return new ResponseEntity<String>("DOC_USED", HttpStatus.BAD_REQUEST);
			}
			documentRepository.delete(document);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("document not found with id " + documentId));
	}

	@RequestMapping(path = "/getListDocument", method = RequestMethod.GET)
	public List<Document> getListDocument(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<Document> docs = documentRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return docs;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Document[] { documentRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				System.err.println(e);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}

	}

	@RequestMapping(path = "/getDocNameById", method = RequestMethod.GET)
	public String getDocNameById(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			long longId = Long.parseLong(id);
			return documentRepository.findById(longId).map(doc -> {
				return doc.getName();
			}).orElseThrow(() -> new ResourceNotFoundException("Document not found with id " + longId));
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@GetMapping("/getFileOfDocument")
	public Set<File> addFileForPart(@RequestParam Long id) {
		return documentRepository.findById(id).map(document -> {
			return document.getFiles();
		}).orElseThrow(() -> new ResourceNotFoundException("Document not found with id " + id));
	}

	@RequestMapping(path = "/checkDocumentName", method = RequestMethod.GET)
	public Boolean checkDocumentName(@RequestParam String name) {
		return documentRepository.existsByName(name.trim());
	}
}
