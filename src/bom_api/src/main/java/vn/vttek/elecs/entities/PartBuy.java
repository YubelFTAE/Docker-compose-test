package vn.vttek.elecs.entities;

import java.io.Serializable;
import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;

@Entity
//@Table(uniqueConstraints = @UniqueConstraint(columnNames = {"config_id", "related_id"}))
@SequenceGenerator(name = "part_buyIdSeq", sequenceName = "part_buy_id_seq", allocationSize = 1)
public class PartBuy implements Serializable {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "part_buyIdSeq")
	private Long id;
	private String classification;
	private Long config_id;
	private String created_by_id;
	private Date create_on;
	private String current_state;
	private Long generation;
	private Boolean is_current;
	private Boolean is_released;
	private Long locked_by_id;
	private String major_rev;
	private Long manufacturer_id;
	private String manufacturer;
	private Long modified_by_id;
	private Date modified_on;
	private Boolean not_lockable;
	private Long permission_id;
	private Long related_id;
	private Long sort_order;
	private Long source_id;
	private String state;
	private Long vendor_id;

	public Long getId() {
		return id;
	}

	public void setIs_current(Boolean is_current) {
		this.is_current = is_current;
	}

	public void setIs_released(Boolean is_released) {
		this.is_released = is_released;
	}

	public void setLocked_by_id(Long locked_by_id) {
		this.locked_by_id = locked_by_id;
	}

	public void setManufacturer_id(Long manufacturer_id) {
		this.manufacturer_id = manufacturer_id;
	}

	public void setModified_by_id(Long modified_by_id) {
		this.modified_by_id = modified_by_id;
	}

	public void setNot_lockable(Boolean not_lockable) {
		this.not_lockable = not_lockable;
	}

	public void setVendor_id(Long vendor_id) {
		this.vendor_id = vendor_id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getClassification() {
		return classification;
	}

	public void setClassification(String classification) {
		this.classification = classification;
	}

	public Long getConfig_id() {
		return config_id;
	}

	public void setConfig_id(Long config_id) {
		this.config_id = config_id;
	}

	public String getCreated_by_id() {
		return created_by_id;
	}

	public void setCreated_by_id(String created_by_id) {
		this.created_by_id = created_by_id;
	}

	public Date getCreate_on() {
		return create_on;
	}

	public void setCreate_on(Date create_on) {
		this.create_on = create_on;
	}

	public String getCurrent_state() {
		return current_state;
	}

	public void setCurrent_state(String current_state) {
		this.current_state = current_state;
	}

	public Long getGeneration() {
		return generation;
	}

	public void setGeneration(Long generation) {
		this.generation = generation;
	}

	public String getMajor_rev() {
		return major_rev;
	}

	public void setMajor_rev(String major_rev) {
		this.major_rev = major_rev;
	}

	public String getManufacturer() {
		return manufacturer;
	}

	public void setManufacturer(String manufacturer) {
		this.manufacturer = manufacturer;
	}

	public Date getModified_on() {
		return modified_on;
	}

	public void setModified_on(Date modified_on) {
		this.modified_on = modified_on;
	}

	public Long getPermission_id() {
		return permission_id;
	}

	public void setPermission_id(Long permission_id) {
		this.permission_id = permission_id;
	}

	public Long getRelated_id() {
		return related_id;
	}

	public void setRelated_id(Long related_id) {
		this.related_id = related_id;
	}

	public Long getSort_order() {
		return sort_order;
	}

	public void setSort_order(Long sort_order) {
		this.sort_order = sort_order;
	}

	public Long getSource_id() {
		return source_id;
	}

	public void setSource_id(Long source_id) {
		this.source_id = source_id;
	}

	public String getState() {
		return state;
	}

	public void setState(String state) {
		this.state = state;
	}

	public Boolean getIs_current() {
		return is_current;
	}

	public Boolean getIs_released() {
		return is_released;
	}

	public Long getLocked_by_id() {
		return locked_by_id;
	}

	public Long getManufacturer_id() {
		return manufacturer_id;
	}

	public Long getModified_by_id() {
		return modified_by_id;
	}

	public Boolean getNot_lockable() {
		return not_lockable;
	}

	public Long getVendor_id() {
		return vendor_id;
	}

}
