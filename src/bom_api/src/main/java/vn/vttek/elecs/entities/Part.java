package vn.vttek.elecs.entities;

import java.io.Serializable;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.JoinTable;
import javax.persistence.ManyToMany;
import javax.persistence.SequenceGenerator;
import javax.persistence.Transient;

import org.hibernate.annotations.OnDelete;
import org.hibernate.annotations.OnDeleteAction;

import com.fasterxml.jackson.annotation.JsonFilter;

import vn.vttek.elecs.model.ManufacturerModel;

//@JsonFilter("myFilter")
@Entity
@SequenceGenerator(name = "partIdSeq", sequenceName = "part_id_seq", allocationSize = 1)
public class Part implements Serializable, Cloneable {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "partIdSeq")
	private Long id;
	@Column(length = 2000)
	private String item_number;
	@Column(length = 2000)
	private String name;
	@Column(length = 2000)
	private String description;
	@Column(length = 2000)
	private String category;
	@Column(length = 2000)
	private String manufacturer;
	private Long number_manufacturer_res;
	private Timestamp lead_time = new Timestamp(System.currentTimeMillis());
	@Column(length = 2000)
	private String classification;
	@Column(length = 2000)
	private String state;
	@Column(length = 2000)
	private String current_state;
	@Column(length = 2000)
	private Long version = 1L;
	private double cost;
//	private Double cost_basis = 123D;
	@Column(length = 2000)
	private String make_by;
	@Column(length = 2000)
	private String unit;
	@Column(length = 2000)
	private String weight;
	@Column(length = 2000)
	private String thumbnail;
	private Long created_by_id;
	private Timestamp created_on = new Timestamp(System.currentTimeMillis());
	private Long modified_by_id;
	private Timestamp modified_on = new Timestamp(System.currentTimeMillis());
	private Long locked_by_id;
	private boolean not_lockable = true;
	private Long config_id;
	private Long generation;
	private Timestamp release_date = new Timestamp(System.currentTimeMillis());
	private Timestamp effective_date = new Timestamp(System.currentTimeMillis());
	private boolean is_released;
	private boolean is_current;
	@Column(length = 2000)
	private String major_rev;
	private boolean has_change_pending;
	@Column(length = 2000)
	private String permission_id;
	@Column(length = 2000)
	private String external_type;
	private long quantity;
	private Long sort_order;
	@Column(length = 2000)
	private String reference_designator;
	@Column(length = 2000)
	private String note;
	private Long is_sure;
	@Column(length = 2000)
	private String adjust_quantity;
	@Column(length = 2000)
	private String packing;
	
	@Transient
	private Integer offsetManufacturer;
	@Transient
	private List<Part> children = new ArrayList<Part>();
	@Transient
	private int level = 1;

	public List<Part> getChildren() {
		return children;
	}

	public void setChildren(List<Part> children) {
		this.children = children;
	}

	private Long manufacturer_id;

	@ManyToMany(fetch = FetchType.LAZY)
	@JoinTable(name = "part_files", joinColumns = @JoinColumn(name = "part_id"), inverseJoinColumns = @JoinColumn(name = "file_id"))
	private Set<File> files = new HashSet<>();

	@Column(name = "document_id")
	private Integer documentId;

	@Transient
	private List<ManufacturerModel> manufacturerModel = new ArrayList<ManufacturerModel>();

	private Integer active = 1;

	@Column(name = "vendor_id")
	private Integer vendorId;
	
	@Column(name = "vietel_code")
	private String vietelCode;

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getItem_number() {
		return item_number;
	}

	public void setItem_number(String item_number) {
		this.item_number = item_number;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public String getCategory() {
		return category;
	}

	public void setCategory(String category) {
		this.category = category;
	}

	public String getManufacturer() {
		return manufacturer;
	}

	public void setManufacturer(String manufacturer) {
		this.manufacturer = manufacturer;
	}

	public Long getNumber_manufacturer_res() {
		return number_manufacturer_res;
	}

	public void setNumber_manufacturer_res(Long number_manufacturer_res) {
		this.number_manufacturer_res = number_manufacturer_res;
	}

	public Timestamp getLead_time() {
		return lead_time;
	}

	public void setLead_time(Timestamp lead_time) {
		this.lead_time = lead_time;
	}

	public String getClassification() {
		return classification;
	}

	public void setClassification(String classification) {
		this.classification = classification;
	}

	public String getState() {
		return state;
	}

	public void setState(String state) {
		this.state = state;
	}

	public String getCurrent_state() {
		return current_state;
	}

	public void setCurrent_state(String current_state) {
		this.current_state = current_state;
	}

	public Long getVersion() {
		return version;
	}

	public void setVersion(Long version) {
		this.version = version;
	}

	public String getMake_by() {
		return make_by;
	}

	public void setMake_by(String make_by) {
		this.make_by = make_by;
	}

	public String getUnit() {
		return unit;
	}

	public void setUnit(String unit) {
		this.unit = unit;
	}

	public String getWeight() {
		return weight;
	}

	public void setWeight(String weight) {
		this.weight = weight;
	}

	public String getThumbnail() {
		return thumbnail;
	}

	public void setThumbnail(String thumbnail) {
		this.thumbnail = thumbnail;
	}

	public Long getCreated_by_id() {
		return created_by_id;
	}

	public void setCreated_by_id(Long created_by_id) {
		this.created_by_id = created_by_id;
	}

	public Timestamp getCreated_on() {
		return created_on;
	}

	public void setCreated_on(Timestamp created_on) {
		this.created_on = created_on;
	}

	public Long getModified_by_id() {
		return modified_by_id;
	}

	public void setModified_by_id(Long modified_by_id) {
		this.modified_by_id = modified_by_id;
	}

	public Timestamp getModified_on() {
		return modified_on;
	}

	public void setModified_on(Timestamp modified_on) {
		this.modified_on = modified_on;
	}

	public Long getLocked_by_id() {
		return locked_by_id;
	}

	public void setLocked_by_id(Long locked_by_id) {
		this.locked_by_id = locked_by_id;
	}

	public boolean getNot_lockable() {
		return not_lockable;
	}

	public void setNot_lockable(boolean not_lockable) {
		this.not_lockable = not_lockable;
	}

	public Long getConfig_id() {
		return config_id;
	}

	public void setConfig_id(Long config_id) {
		this.config_id = config_id;
	}

	public Long getGeneration() {
		return generation;
	}

	public void setGeneration(Long generation) {
		this.generation = generation;
	}

	public Timestamp getRelease_date() {
		return release_date;
	}

	public void setRelease_date(Timestamp release_date) {
		this.release_date = release_date;
	}

	public Timestamp getEffective_date() {
		return effective_date;
	}

	public void setEffective_date(Timestamp effective_date) {
		this.effective_date = effective_date;
	}

	public boolean getIs_released() {
		return is_released;
	}

	public void setIs_released(boolean is_released) {
		this.is_released = is_released;
	}

	public boolean getIs_current() {
		return is_current;
	}

	public void setIs_current(boolean is_current) {
		this.is_current = is_current;
	}

	public String getMajor_rev() {
		return major_rev;
	}

	public void setMajor_rev(String major_rev) {
		this.major_rev = major_rev;
	}

	public boolean getHas_change_pending() {
		return has_change_pending;
	}

	public void setHas_change_pending(boolean has_change_pending) {
		this.has_change_pending = has_change_pending;
	}

	public String getPermission_id() {
		return permission_id;
	}

	public void setPermission_id(String permission_id) {
		this.permission_id = permission_id;
	}

	public String getExternal_type() {
		return external_type;
	}

	public void setExternal_type(String external_type) {
		this.external_type = external_type;
	}

	public Long getQuantity() {
		return quantity;
	}

	public void setQuantity(Long quantity) {
		this.quantity = quantity;
	}

	public Long getSort_order() {
		return sort_order;
	}

	public void setSort_order(Long sort_order) {
		this.sort_order = sort_order;
	}

	public String getReference_designator() {
		return reference_designator;
	}

	public void setReference_designator(String reference_designator) {
		this.reference_designator = reference_designator;
	}

//	public Double getCost_basis() {
//		return cost_basis;
//	}
//
//	public void setCost_basis(Double cost_basis) {
//		this.cost_basis = cost_basis;
//	}

	public void setCost(Double cost) {
		this.cost = cost;
	}

	public Double getCost() {
		return cost;
	}

	public String getNote() {
		return note;
	}

	public void setNote(String note) {
		this.note = note;
	}

	public Long isIs_sure() {
		return is_sure;
	}

	public void setIs_sure(Long is_sure) {
		this.is_sure = is_sure;
	}

	public String getAdjust_quantity() {
		return adjust_quantity;
	}

	public void setAdjust_quantity(String adjust_quantity) {
		this.adjust_quantity = adjust_quantity;
	}

	public String getPacking() {
		return packing;
	}

	public void setPacking(String packing) {
		this.packing = packing;
	}

	public Integer getOffsetManufacturer() {
		return offsetManufacturer;
	}

	public void setOffsetManufacturer(Integer offsetManufacturer) {
		this.offsetManufacturer = offsetManufacturer;
	}

	public Long getIs_sure() {
		return is_sure;
	}

	public int getLevel() {
		return level;
	}

	public void setLevel(int level) {
		this.level = level;
	}

	// Overriding clone() method of Object class
	public Part clone() {
		try {
			return (Part) super.clone();
		} catch (CloneNotSupportedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}

	public Long getManufacturer_id() {
	    return manufacturer_id;
	}

	public void setManufacturer_id(Long manufacturer_id) {
	    this.manufacturer_id = manufacturer_id;
	}

	public Set<File> getFiles() {
	    return files;
	}

	public void setFiles(Set<File> files) {
	    this.files = files;
	}

	public void addFile(File file) {
	    this.files.add(file);
	}

	public List<ManufacturerModel> getManufacturerModel() {
	    return manufacturerModel;
	}

	public void addManufacturerModel(ManufacturerModel manufacturerModel) {
	    this.manufacturerModel.add(manufacturerModel);
	}

	public Integer getDocumentId() {
	    return documentId;
	}

	public void setDocumentId(Integer documentId) {
	    this.documentId = documentId;
	}

	public Integer getActive() {
	    return active;
	}

	public void setActive(Integer active) {
	    this.active = active;
	}

	public Integer getVendorId() {
	    return vendorId;
	}

	public void setVendorId(Integer vendorId) {
	    this.vendorId = vendorId;
	}

	public String getVietelCode() {
		return vietelCode;
	}

	public void setVietelCode(String vietelCode) {
		this.vietelCode = vietelCode;
	}

	@Override
	public String toString() {
		return "Part [id=" + id + ", item_number=" + item_number + ", offsetManufacturer=" + offsetManufacturer + "]";
	}


}
