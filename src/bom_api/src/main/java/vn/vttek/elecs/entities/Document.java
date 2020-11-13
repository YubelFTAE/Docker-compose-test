package vn.vttek.elecs.entities;

import javax.persistence.*;
import java.io.Serializable;
import java.sql.Timestamp;
import java.util.Date;
import java.util.HashSet;
import java.util.Set;

@Entity
@SequenceGenerator(name = "documentIdSeq", sequenceName = "documents_id_seq", allocationSize = 1)
public class Document implements Serializable {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "documentIdSeq")
	private Long id;
	private String item_number;
	private Date modified_on = new Date();
	private String name;
	private String description;
	private Date created_on = new Date();
	private int created_by_id;
	private int modified_by_id;
	private String current_state;
	private int locked_by_id;
	private boolean is_current;
	private String minor_rev;
	private boolean not_lockable;
	private boolean is_release;
	private int generation;
	private boolean new_version;
	private int config_id;
	private String permission_id;
	private Timestamp effected_date;
	private Timestamp related_date;
	private String authoring_tool;
	private String authoring_tool_version;
	private boolean has_files;

    @ManyToMany(fetch = FetchType.LAZY)
    @JoinTable(name = "document_files", joinColumns = @JoinColumn(name = "document_id"), inverseJoinColumns = @JoinColumn(name = "file_id"))
    private Set<File> files = new HashSet<>();

	public Document() {
	}

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

	public Date getModified_on() {
		return modified_on;
	}

	public void setModified_on(Date modified_on) {
		this.modified_on = modified_on;
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

	public Date getCreated_on() {
		return created_on;
	}

	public void setCreated_on(Date created_on) {
		this.created_on = created_on;
	}

	public int getCreated_by_id() {
		return created_by_id;
	}

	public void setCreated_by_id(int created_by_id) {
		this.created_by_id = created_by_id;
	}

	public int getModified_by_id() {
		return modified_by_id;
	}

	public void setModified_by_id(int modified_by_id) {
		this.modified_by_id = modified_by_id;
	}

	public String getCurrent_state() {
		return current_state;
	}

	public void setCurrent_state(String current_state) {
		this.current_state = current_state;
	}

	public int getLocked_by_id() {
		return locked_by_id;
	}

	public void setLocked_by_id(int locked_by_id) {
		this.locked_by_id = locked_by_id;
	}

	public boolean getIs_current() {
		return is_current;
	}

	public void setIs_current(boolean is_current) {
		this.is_current = is_current;
	}

	public String getMinor_rev() {
		return minor_rev;
	}

	public void setMinor_rev(String minor_rev) {
		this.minor_rev = minor_rev;
	}

	public boolean getNot_lockable() {
		return not_lockable;
	}

	public void setNot_lockable(boolean not_lockable) {
		this.not_lockable = not_lockable;
	}

	public boolean getIs_release() {
		return is_release;
	}

	public void setIs_release(boolean is_release) {
		this.is_release = is_release;
	}

	public int getGeneration() {
		return generation;
	}

	public void setGeneration(int generation) {
		this.generation = generation;
	}

	public boolean getNew_version() {
		return new_version;
	}

	public void setNew_version(boolean new_version) {
		this.new_version = new_version;
	}

	public int getConfig_id() {
		return config_id;
	}

	public void setConfig_id(int config_id) {
		this.config_id = config_id;
	}

	public String getPermission_id() {
		return permission_id;
	}

	public void setPermission_id(String permission_id) {
		this.permission_id = permission_id;
	}

	public Timestamp getEffected_date() {
		return effected_date;
	}

	public void setEffected_date(Timestamp effected_date) {
		this.effected_date = effected_date;
	}

	public Timestamp getRelated_date() {
		return related_date;
	}

	public void setRelated_date(Timestamp related_date) {
		this.related_date = related_date;
	}

	public String getAuthoring_tool() {
		return authoring_tool;
	}

	public void setAuthoring_tool(String authoring_tool) {
		this.authoring_tool = authoring_tool;
	}

	public String getAuthoring_tool_version() {
		return authoring_tool_version;
	}

	public void setAuthoring_tool_version(String authoring_tool_version) {
		this.authoring_tool_version = authoring_tool_version;
	}

	public boolean getHas_files() {
		return has_files;
	}

	public void setHas_files(boolean has_files) {
		this.has_files = has_files;
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
}
