package vn.vttek.elecs.message.request;

import java.util.List;
import vn.vttek.elecs.entities.File;

public class FileRequest {
    private Long partId;
    private Long documentId;
    private List<Long> fileIds;
    private List<File> files;
    private int type;

    public Long getPartId() {
	return partId;
    }

    public void setPartId(Long partId) {
	this.partId = partId;
    }

    public Long getDocumentId() {
	return documentId;
    }

    public void setDocumentId(Long documentId) {
	this.documentId = documentId;
    }

    public List<Long> getFileIds() {
	return fileIds;
    }

    public void setFileIds(List<Long> fileIds) {
	this.fileIds = fileIds;
    }

    public List<File> getFiles() {
	return files;
    }

    public void setFiles(List<File> files) {
	this.files = files;
    }

    public int getType() {
	return type;
    }

    public void setType(int type) {
	this.type = type;
    }

}
