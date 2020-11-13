package vn.vttek.elecs.entities;

import java.io.Serializable;
import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;

@Entity
@SequenceGenerator(name = "bom_instanceIdSeq", sequenceName = "bom_instance_id_seq", allocationSize = 1)
public class BomInstance implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "bom_instanceIdSeq")
    private Long id;
    private String classification;
    private String keyed_name;
    private String owner_by_id;
    private Date create_on;
    private String manufacturer;
    private String created_by_id;
    private Date modified_on;
    private String modified_by_id;
    private String state;
    private String locked_by_id;
    private String current_state;
    private String major_rev;
    private String is_current;
    private String is_released;
    private String not_lockable;
    private Long generation;
    private Long permission_id;
    private Long config_id;
    private Long source_id;
    private Long related_id;
    private Long sort_order;
    private Float y;
    private Float z;
    private Float x;
    private String reference_designator;
    private String side;
    private Float angle;
    private String behavior;
    private String team_id;
    private String new_version;
    private String css;
    private String minor_rev;
    private String manager_by_id;

    public BomInstance() {
    }


    public BomInstance(Long id, String classification, String keyed_name, String owner_by_id, Date create_on,
			String manufacturer, String created_by_id, Date modified_on, String modified_by_id, String state,
			String locked_by_id, String current_state, String major_rev, String is_current, String is_released,
			String not_lockable, Long generation, Long permission_id, Long config_id, Long source_id, Long related_id,
			Long sort_order, Float y, Float z, Float x, String reference_designator, String side, Float angle,
			String behavior, String team_id, String new_version, String css, String minor_rev, String manager_by_id) {
		super();
		this.id = id;
		this.classification = classification;
		this.keyed_name = keyed_name;
		this.owner_by_id = owner_by_id;
		this.create_on = create_on;
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
		this.y = y;
		this.z = z;
		this.x = x;
		this.reference_designator = reference_designator;
		this.side = side;
		this.angle = angle;
		this.behavior = behavior;
		this.team_id = team_id;
		this.new_version = new_version;
		this.css = css;
		this.minor_rev = minor_rev;
		this.manager_by_id = manager_by_id;
	}


	public String getClassification() {
		return classification;
	}


	public void setClassification(String classification) {
		this.classification = classification;
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


	public void setY(Float y) {
		this.y = y;
	}


	public void setZ(Float z) {
		this.z = z;
	}


	public void setX(Float x) {
		this.x = x;
	}


	public void setAngle(Float angle) {
		this.angle = angle;
	}


	public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }


    public String getKeyed_name() {
        return keyed_name;
    }

    public void setKeyed_name(String keyed_name) {
        this.keyed_name = keyed_name;
    }

    public String getOwner_by_id() {
        return owner_by_id;
    }

    public void setOwner_by_id(String owner_by_id) {
        this.owner_by_id = owner_by_id;
    }

    public Date getCreate_on() {
        return create_on;
    }

    public void setCreate_on(Date create_on) {
        this.create_on = create_on;
    }

    public String getManufacturer() {
        return manufacturer;
    }

    public void setManufacturer(String manufacturer) {
        this.manufacturer = manufacturer;
    }

    public String getCreated_by_id() {
        return created_by_id;
    }

    public void setCreated_by_id(String created_by_id) {
        this.created_by_id = created_by_id;
    }

    public Date getModified_on() {
        return modified_on;
    }

    public void setModified_on(Date modified_on) {
        this.modified_on = modified_on;
    }

    public String getModified_by_id() {
        return modified_by_id;
    }

    public void setModified_by_id(String modified_by_id) {
        this.modified_by_id = modified_by_id;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getLocked_by_id() {
        return locked_by_id;
    }

    public void setLocked_by_id(String locked_by_id) {
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

    public String getIs_current() {
        return is_current;
    }

    public void setIs_current(String is_current) {
        this.is_current = is_current;
    }

    public String getIs_released() {
        return is_released;
    }

    public void setIs_released(String is_released) {
        this.is_released = is_released;
    }

    public String getNot_lockable() {
        return not_lockable;
    }

    public void setNot_lockable(String not_lockable) {
        this.not_lockable = not_lockable;
    }


    public float getY() {
        return y;
    }

    public void setY(float y) {
        this.y = y;
    }

    public float getZ() {
        return z;
    }

    public void setZ(float z) {
        this.z = z;
    }

    public float getX() {
        return x;
    }

    public void setX(float x) {
        this.x = x;
    }

    public String getReference_designator() {
        return reference_designator;
    }

    public void setReference_designator(String reference_designator) {
        this.reference_designator = reference_designator;
    }

    public String getSide() {
        return side;
    }

    public void setSide(String side) {
        this.side = side;
    }

    public float getAngle() {
        return angle;
    }

    public void setAngle(float angle) {
        this.angle = angle;
    }

    public String getBehavior() {
        return behavior;
    }

    public void setBehavior(String behavior) {
        this.behavior = behavior;
    }

    public String getTeam_id() {
        return team_id;
    }

    public void setTeam_id(String team_id) {
        this.team_id = team_id;
    }

    public String getNew_version() {
        return new_version;
    }

    public void setNew_version(String new_version) {
        this.new_version = new_version;
    }

    public String getCss() {
        return css;
    }

    public void setCss(String css) {
        this.css = css;
    }

    public String getMinor_rev() {
        return minor_rev;
    }

    public void setMinor_rev(String minor_rev) {
        this.minor_rev = minor_rev;
    }

    public String getManager_by_id() {
        return manager_by_id;
    }

    public void setManager_by_id(String manager_by_id) {
        this.manager_by_id = manager_by_id;
    }
}
