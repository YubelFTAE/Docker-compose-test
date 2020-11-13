package vn.vttek.elecs.entities;

import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;

@Entity
@SequenceGenerator(name = "manufacturerIdSeq", sequenceName = "manufacturer_id_seq", allocationSize = 1)
public class Manufacturer {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "manufacturerIdSeq")
	private Long id;

	private int created_by_id;
	private String name;
	private String state;
	private String phone;
	private String contact_name;
	private Date created_on = new Date();
	private Date modified_on = new Date();

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public int getCreated_by_id() {
		return created_by_id;
	}

	public void setCreated_by_id(int created_by_id) {
		this.created_by_id = created_by_id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getState() {
		return state;
	}

	public void setState(String state) {
		this.state = state;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}

	public String getContact_name() {
		return contact_name;
	}

	public void setContact_name(String contact_name) {
		this.contact_name = contact_name;
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
