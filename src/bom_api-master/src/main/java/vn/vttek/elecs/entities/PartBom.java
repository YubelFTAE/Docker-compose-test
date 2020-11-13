package vn.vttek.elecs.entities;

import java.io.Serializable;
import java.sql.Timestamp;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;

@Entity
//@Table(uniqueConstraints = @UniqueConstraint(columnNames = {"config_id", "related_id"}))
@SequenceGenerator(name = "part_bomIdSeq", sequenceName = "part_bom_id_seq", allocationSize = 1)
public class PartBom implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "part_bomIdSeq")
    private Long id;
    private String classification;
    private String state;
    private String current_state;
    private Timestamp created_on;
    private long created_by_id;
    private Timestamp modified_on;
    private long locked_by_id;
    private boolean not_lockable;
    private Timestamp superseded_date;
    private long config_id;
    private long generation;
    private boolean is_released;
    private boolean is_current;
    private String major_rev;
    private String permission_id;
    private String external_type;
    private long source_id;
    private long related_id;
    private Long quantity;
    private long sort_ordered;
    @Column(length = 2000)
    private String reference_designator;
    private String description;
    private String unit;
    private String value;
    private String manufacturer;
    private String part_number;

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

    public Timestamp getCreated_on() {
        return created_on;
    }

    public void setCreated_on(Timestamp created_on) {
        this.created_on = created_on;
    }

    public long getCreated_by_id() {
        return created_by_id;
    }

    public void setCreated_by_id(long created_by_id) {
        this.created_by_id = created_by_id;
    }

    public Timestamp getModified_on() {
        return modified_on;
    }

    public void setModified_on(Timestamp modified_on) {
        this.modified_on = modified_on;
    }

    public long getLocked_by_id() {
        return locked_by_id;
    }

    public void setLocked_by_id(long locked_by_id) {
        this.locked_by_id = locked_by_id;
    }

    public boolean getNot_lockable() {
        return not_lockable;
    }

    public void setNot_lockable(boolean not_lockable) {
        this.not_lockable = not_lockable;
    }

    public Timestamp getSuperseded_date() {
        return superseded_date;
    }

    public void setSuperseded_date(Timestamp superseded_date) {
        this.superseded_date = superseded_date;
    }

    public long getConfig_id() {
        return config_id;
    }

    public void setConfig_id(long config_id) {
        this.config_id = config_id;
    }

    public long getGeneration() {
        return generation;
    }

    public void setGeneration(long generation) {
        this.generation = generation;
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

    public long getSource_id() {
        return source_id;
    }

    public void setSource_id(long source_id) {
        this.source_id = source_id;
    }

    public long getRelated_id() {
        return related_id;
    }

    public void setRelated_id(long related_id) {
        this.related_id = related_id;
    }

    public Long getQuantity() {
        return quantity;
    }

    public void setQuantity(Long quantity) {
        this.quantity = quantity;
    }

    public long getSort_ordered() {
        return sort_ordered;
    }

    public void setSort_ordered(long sort_ordered) {
        this.sort_ordered = sort_ordered;
    }

    public String getReference_designator() {
        return reference_designator;
    }

    public void setReference_designator(String reference_designator) {
        this.reference_designator = reference_designator;
    }

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public String getUnit() {
		return unit;
	}

	public void setUnit(String unit) {
		this.unit = unit;
	}

	public String getValue() {
		return value;
	}

	public void setValue(String value) {
		this.value = value;
	}

	public String getManufacturer() {
		return manufacturer;
	}

	public void setManufacturer(String manufacturer) {
		this.manufacturer = manufacturer;
	}

	public String getPart_number() {
		return part_number;
	}

	public void setPart_number(String part_number) {
		this.part_number = part_number;
	}    
}
