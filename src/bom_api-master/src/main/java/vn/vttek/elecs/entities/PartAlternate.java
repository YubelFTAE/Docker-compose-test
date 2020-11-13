package vn.vttek.elecs.entities;

import java.io.Serializable;
import java.sql.Timestamp;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;

@Entity
//@Table(uniqueConstraints = @UniqueConstraint(columnNames = {"config_id", "related_id"}))
@SequenceGenerator(name = "part_alternateIdSeq", sequenceName = "part_alternate_id_seq", allocationSize = 1)
public class PartAlternate implements Serializable {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "part_alternateIdSeq")
	private Long id;
	private String classification;
	private Timestamp created_on;
	private String manufacturer;
	private Long created_by_id;
	private Timestamp modified_on;
	private Long modified_by_id;
	private String state;
	private Long locked_by_id;
	private String current_state;
	private String major_rev;
	private boolean is_current;
	private boolean is_released;
	private boolean not_lockable;
	private Long generation;
	private Long permission_id;
	private Long config_id;
	private Long source_id;
	private Long related_id;
	private Long sort_order;

	public PartAlternate() {
		super();
	}

	public PartAlternate(Long id, String classification, Timestamp created_on, String manufacturer, Long created_by_id,
			Timestamp modified_on, Long modified_by_id, String state, Long locked_by_id, String current_state,
			String major_rev, boolean is_current, boolean is_released, boolean not_lockable, Long generation,
			Long permission_id, Long config_id, Long source_id, Long related_id, Long sort_order) {
		super();
		this.id = id;
		this.classification = classification;
		this.created_on = created_on;
		this.manufacturer = manufacturer;
		this.created_by_id = created_by_id;
		this.modified_on = modified_on;
		this.modified_by_id = modified_by_id;
		this.state = state;
		this.locked_by_id = locked_by_id;
		this.current_state = current_state;
		this.major_rev = major_rev;
		this.is_current = is_current;
		this.is_released = is_released;
		this.not_lockable = not_lockable;
		this.generation = generation;
		this.permission_id = permission_id;
		this.config_id = config_id;
		this.source_id = source_id;
		this.related_id = related_id;
		this.sort_order = sort_order;
	}

	public Long getId() {
		return id;
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

	public Timestamp getCreated_on() {
		return created_on;
	}

	public void setCreated_on(Timestamp created_on) {
		this.created_on = created_on;
	}

	public String getManufacturer() {
		return manufacturer;
	}

	public void setManufacturer(String manufacturer) {
		this.manufacturer = manufacturer;
	}

	public Long getCreated_by_id() {
		return created_by_id;
	}

	public void setCreated_by_id(Long created_by_id) {
		this.created_by_id = created_by_id;
	}

	public Timestamp getModified_on() {
		return modified_on;
	}

	public void setModified_on(Timestamp modified_on) {
		this.modified_on = modified_on;
	}

	public Long getModified_by_id() {
		return modified_by_id;
	}

	public void setModified_by_id(Long modified_by_id) {
		this.modified_by_id = modified_by_id;
	}

	public String getState() {
		return state;
	}

	public void setState(String state) {
		this.state = state;
	}

	public Long getLocked_by_id() {
		return locked_by_id;
	}

	public void setLocked_by_id(Long locked_by_id) {
		this.locked_by_id = locked_by_id;
	}

	public String getCurrent_state() {
		return current_state;
	}

	public void setCurrent_state(String current_state) {
		this.current_state = current_state;
	}

	public String getMajor_rev() {
		return major_rev;
	}

	public void setMajor_rev(String major_rev) {
		this.major_rev = major_rev;
	}

	public boolean isIs_current() {
		return is_current;
	}

	public void setIs_current(boolean is_current) {
		this.is_current = is_current;
	}

	public boolean isIs_released() {
		return is_released;
	}

	public void setIs_released(boolean is_released) {
		this.is_released = is_released;
	}

	public boolean isNot_lockable() {
		return not_lockable;
	}

	public void setNot_lockable(boolean not_lockable) {
		this.not_lockable = not_lockable;
	}

	public Long getGeneration() {
		return generation;
	}

	public void setGeneration(Long generation) {
		this.generation = generation;
	}

	public Long getPermission_id() {
		return permission_id;
	}

	public void setPermission_id(Long permission_id) {
		this.permission_id = permission_id;
	}

	public Long getConfig_id() {
		return config_id;
	}

	public void setConfig_id(Long config_id) {
		this.config_id = config_id;
	}

	public Long getSource_id() {
		return source_id;
	}

	public void setSource_id(Long source_id) {
		this.source_id = source_id;
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

}
