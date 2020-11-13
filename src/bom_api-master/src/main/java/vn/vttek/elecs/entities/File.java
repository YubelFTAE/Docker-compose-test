package vn.vttek.elecs.entities;

import javax.persistence.*;
import java.io.Serializable;
import java.util.Date;

@Entity
@SequenceGenerator(name = "fileIdSeq", sequenceName = "file_id_seq", allocationSize = 1)
public class File implements Serializable {
    private static final long serialVersionUID = -141157125244418391L;

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "fileIdSeq")
    private Long id;

    @Column(name = "document_id")
    private int documentId;
    private String classification;
    private String checksum;
    private String label;
    @Column(name = "config_id")
    private String configId;
    @Column(name = "created_by_id")
    private String createdById;
    @Column(name = "created_on")
    private Date createOn;
    @Column(name = "current_state")
    private String currentState;
    private int genetation;
    @Column(name = "is_current")
    private String isCurrent;
    @Column(name = "is_released")
    private String isReleased;
    @Column(name = "keyed_name")
    private String keyedName;
    @Column(name = "locked_by_id")
    private String lockedById;
    @Column(name = "major_rev")
    private String majorRev;
    @Column(name = "manager_by_id")
    private String managerById;
    @Column(name = "minor_rev")
    private String minorRev;
    @Column(name = "modified_on")
    private Date modifiedOn;
    @Column(name = "modified_by_id")
    private String modifiedById;
    @Column(name = "new_version")
    private String newVersion;
    @Column(name = "not_lockable")
    private String notLockable;
    @Column(name = "owner_by_id")
    private String ownerById;
    @Column(name = "permission_id")
    private String permissionId;
    private String state;
    @Column(name = "indexed_on")
    private Date indexedOn;
    @Column(name = "file_name")
    private String fileName;
    @Column(name = "file_type")
    private String fileType;
    private String comments;
    @Column(name = "file_size")
    private Double fileSize;
    @Column(name = "mine_type")
    private String mimeType;
    @Column(name = "checkout_path")
    private String checkoutPath;
    @Column(name = "file_path")
    private String filePath;

    public Long getId() {
	return id;
    }

    public void setId(Long id) {
	this.id = id;
    }

    public int getDocumentId() {
	return documentId;
    }

    public void setDocumentId(int documentId) {
	this.documentId = documentId;
    }

    public String getClassification() {
	return classification;
    }

    public void setClassification(String classification) {
	this.classification = classification;
    }

    public String getChecksum() {
	return checksum;
    }

    public void setChecksum(String checksum) {
	this.checksum = checksum;
    }

    public String getLabel() {
	return label;
    }

    public void setLabel(String label) {
	this.label = label;
    }

    public String getConfigId() {
	return configId;
    }

    public void setConfigId(String configId) {
	this.configId = configId;
    }

    public String getCreatedById() {
	return createdById;
    }

    public void setCreatedById(String createdById) {
	this.createdById = createdById;
    }

    public Date getCreateOn() {
	return createOn;
    }

    public void setCreateOn(Date createOn) {
	this.createOn = createOn;
    }

    public String getCurrentState() {
	return currentState;
    }

    public void setCurrentState(String currentState) {
	this.currentState = currentState;
    }

    public int getGenetation() {
	return genetation;
    }

    public void setGenetation(int genetation) {
	this.genetation = genetation;
    }

    public String isCurrent() {
	return isCurrent;
    }

    public void setCurrent(String isCurrent) {
	this.isCurrent = isCurrent;
    }

    public String isReleased() {
	return isReleased;
    }

    public void setReleased(String isReleased) {
	this.isReleased = isReleased;
    }

    public String getKeyedName() {
	return keyedName;
    }

    public void setKeyedName(String keyedName) {
	this.keyedName = keyedName;
    }

    public String getLockedById() {
	return lockedById;
    }

    public void setLockedById(String lockedById) {
	this.lockedById = lockedById;
    }

    public String getMajorRev() {
	return majorRev;
    }

    public void setMajorRev(String majorRev) {
	this.majorRev = majorRev;
    }

    public String getManagerById() {
	return managerById;
    }

    public void setManagerById(String managerById) {
	this.managerById = managerById;
    }

    public String getMinorRev() {
	return minorRev;
    }

    public void setMinorRev(String minorRev) {
	this.minorRev = minorRev;
    }

    public Date getModifiedOn() {
	return modifiedOn;
    }

    public void setModifiedOn(Date modifiedOn) {
	this.modifiedOn = modifiedOn;
    }

    public String getModifiedById() {
	return modifiedById;
    }

    public void setModifiedById(String modifiedById) {
	this.modifiedById = modifiedById;
    }

    public String getNewVersion() {
	return newVersion;
    }

    public void setNewVersion(String newVersion) {
	this.newVersion = newVersion;
    }

    public String getNotLockable() {
	return notLockable;
    }

    public void setNotLockable(String notLockable) {
	this.notLockable = notLockable;
    }

    public String getOwnerById() {
	return ownerById;
    }

    public void setOwnerById(String ownerById) {
	this.ownerById = ownerById;
    }

    public String getPermissionId() {
	return permissionId;
    }

    public void setPermissionId(String permissionId) {
	this.permissionId = permissionId;
    }

    public String getState() {
	return state;
    }

    public void setState(String state) {
	this.state = state;
    }

    public Date getIndexedOn() {
	return indexedOn;
    }

    public void setIndexedOn(Date indexedOn) {
	this.indexedOn = indexedOn;
    }

    public String getFileName() {
	return fileName;
    }

    public void setFileName(String fileName) {
	this.fileName = fileName;
    }

    public String getFileType() {
	return fileType;
    }

    public void setFileType(String fileType) {
	this.fileType = fileType;
    }

    public String getComments() {
	return comments;
    }

    public void setComments(String comments) {
	this.comments = comments;
    }

    public Double getFileSize() {
	return fileSize;
    }

    public void setFileSize(Double fileSize) {
	this.fileSize = fileSize;
    }

    public String getMimeType() {
	return mimeType;
    }

    public void setMimeType(String mimeType) {
	this.mimeType = mimeType;
    }

    public String getCheckoutPath() {
	return checkoutPath;
    }

    public void setCheckoutPath(String checkoutPath) {
	this.checkoutPath = checkoutPath;
    }

    public String getFilePath() {
	return filePath;
    }

    public void setFilePath(String filePath) {
	this.filePath = filePath;
    }

}
