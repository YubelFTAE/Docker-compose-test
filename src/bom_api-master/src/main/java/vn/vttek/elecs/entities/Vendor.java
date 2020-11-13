package vn.vttek.elecs.entities;

import java.util.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;

@Entity
@SequenceGenerator(name = "vendorIdSeq", sequenceName = "vendor_id_seq", allocationSize = 1)
public class Vendor {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO, generator = "manufacturerIdSeq")
	private Long id;

	private String name;
	private String phone;
	@Column(name = "created_by_id")
	private int createdById;
	@Column(name = "contact_name")
	private String contactName;
	@Column(name = "created_on")
	private Date createdOn = new Date();
	@Column(name = "modified_on")
	private Date modifiedOn = new Date();

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}

	public int getCreatedById() {
		return createdById;
	}

	public void setCreatedById(int createdById) {
		this.createdById = createdById;
	}

	public String getContactName() {
		return contactName;
	}

	public void setContactName(String contactName) {
		this.contactName = contactName;
	}

	public Date getCreatedOn() {
		return createdOn;
	}

	public void setCreatedOn(Date createdOn) {
		this.createdOn = createdOn;
	}

	public Date getModifiedOn() {
		return modifiedOn;
	}

	public void setModifiedOn(Date modifiedOn) {
		this.modifiedOn = modifiedOn;
	}

}
