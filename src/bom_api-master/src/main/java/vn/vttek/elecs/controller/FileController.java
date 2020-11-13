package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Sort;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import vn.vttek.elecs.entities.Document;
import vn.vttek.elecs.entities.File;
import vn.vttek.elecs.entities.Part;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.message.request.FileRequest;
import vn.vttek.elecs.repository.DocumentRepository;
import vn.vttek.elecs.repository.FileRepository;
import vn.vttek.elecs.repository.PartRepository;

import javax.validation.Valid;
import java.util.Arrays;
import java.util.List;
import java.util.Set;

@RestController
@RequestMapping("/file")
public class FileController {

	@Autowired
	private FileRepository fileRepository;

	@Autowired
	private PartRepository partRepository;

	@Autowired
	private DocumentRepository documentRepository;

	@RequestMapping(path = "/getListFile", method = RequestMethod.GET)
	public List<File> getListFile(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<File> deps = fileRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return deps;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new File[] { fileRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				System.err.println(e);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}
	}

	@PostMapping("/addNewFile")
	public File createFile(@Valid @RequestBody File file) {
		return fileRepository.save(file);
	}

	@PutMapping("/updateFile/{fileId}")
	public File updateFile(@PathVariable Long fileId, @Valid @RequestBody File fileRequest) {
		return fileRepository.findById(fileId).map(file -> {

			return fileRepository.save(file);
		}).orElseThrow(() -> new ResourceNotFoundException("file not found with id " + fileId));
	}

	@DeleteMapping("/deleteFile/{fileId}")
	public ResponseEntity<?> deleteFile(@PathVariable Long fileId) {
		return fileRepository.findById(fileId).map(file -> {
			fileRepository.delete(file);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("file not found with id " + fileId));
	}

	@PutMapping("/addFileForPart")
	public Boolean addFileForPart(@Valid @RequestBody FileRequest fileRequest) {
		try {
			Part part = partRepository.getOne(fileRequest.getPartId());
			if (part == null)
				throw new Exception("Part not found");

			if (fileRequest.getType() == 0) {
				List<File> files = fileRepository.findAllById(fileRequest.getFileIds());
				if (files.size() == 0) {
					return false;
				}

				for (File file : files) {
					part.addFile(file);
				}

				partRepository.save(part);
				return true;
			} else {
				Document document = documentRepository.getOne(fileRequest.getDocumentId());
				if (document == null)
					throw new Exception("Document not found");
				List<File> files = fileRequest.getFiles();
				if (files.size() == 0) {
					return false;
				}

				for (File file : files) {
					file.setDocumentId(document.getId().intValue());
					part.addFile(file);
					document.addFile(file);
				}

				fileRepository.saveAll(files);

				documentRepository.save(document);
				partRepository.save(part);
				return true;
			}
		} catch (Exception e) {
			System.err.println(e);
		}
		return false;
	}

	@GetMapping("/getListFileByPartId")
	public Set<File> addFileForPart(@RequestParam Long part_id) {
		return partRepository.findById(part_id).map(part -> {
			return part.getFiles();
		}).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + part_id));
	}

	@PutMapping("/deleteFileOfPart/{partId}")
	public Part deleteFileOfPart(@PathVariable Long partId, @RequestParam List<Long> fileIds) {
		return partRepository.findById(partId).map(part -> {
			List<File> files = fileRepository.findAllById(fileIds);

			part.getFiles().removeAll(files);
			return partRepository.save(part);
		}).orElseThrow(() -> new ResourceNotFoundException("part not found with id " + partId));
	}

	@PutMapping("/deleteFileOfDocument/{documentId}")
	public Document deleteFileOfDocument(@PathVariable Long documentId, @RequestParam List<Long> fileIds) {
		return documentRepository.findById(documentId).map(doc -> {
			List<File> files = fileRepository.findAllById(fileIds);

			doc.getFiles().removeAll(files);
			fileRepository.deleteAll(files);
			return documentRepository.save(doc);
		}).orElseThrow(() -> new ResourceNotFoundException("document not found with id " + documentId));
	}
}
