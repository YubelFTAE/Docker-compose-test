package vn.vttek.elecs.entities;

import javax.persistence.*;
import java.io.Serializable;
import java.sql.Timestamp;
import java.util.Date;

@Entity
@SequenceGenerator(name = "departmentIdSeq", sequenceName = "department_id_seq", allocationSize = 1)
public class Department implements Serializable {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "departmentIdSeq")
	private Long id;

	private int par_id;
	private String code;
	private String name;
	private String description;
	private Date created_on = new Date();
	private Date modified_on = new Date();

	public Department() {
	}

	public Department(int par_id, String code, String name, String description) {
		this.par_id = par_id;
		this.code = code;
		this.name = name;
		this.description = description;
		this.created_on = new Date();
		this.modified_on = new Date();
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public int getPar_id() {
		return par_id;
	}

	public void setPar_id(int par_id) {
		this.par_id = par_id;
	}

	public String getCode() {
		return code;
	}

	public void setCode(String code) {
		this.code = code;
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

	public Date getModified_on() {
		return modified_on;
	}

	public void setModified_on(Date modified_on) {
		this.modified_on = modified_on;
	}
}
