package vn.vttek.elecs.entities;

import java.io.IOException;
import java.io.Serializable;
import java.sql.Timestamp;
import java.util.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.SequenceGenerator;

import com.fasterxml.jackson.databind.ObjectMapper;

@Entity
@SequenceGenerator(name = "productIdSeq", sequenceName = "product_id_seq", allocationSize = 1)
public class Product implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "productIdSeq")
    private Long id;
    private String item_number;
    private String name;
    private String description;
    private Long created_by_id;
    private Date created_on = new Date();
    private Short lock;
    private int modified_by_id;
    private Date modified_on = new Date();
    private String state;
    @Column(name = "project_id")
	private Long projectId;

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

    public Date getCreated_on() {
        return created_on;
    }

    public void setCreated_on(Date created_on) {
        this.created_on = created_on;
    }

    public int getModified_by_id() {
        return modified_by_id;
    }

    public void setModified_by_id(int modified_by_id) {
        this.modified_by_id = modified_by_id;
    }

    public Date getModified_on() {
        return modified_on;
    }

    public void setModified_on(Date modified_on) {
        this.modified_on = modified_on;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }
    
    public Short getLock() {
		return lock;
	}

	public void setLock(Short lock) {
		this.lock = lock;
	}

	public void setCreated_by_id(Long created_by_id) {
		this.created_by_id = created_by_id;
	}

	public Long getCreated_by_id() {
		return created_by_id;
	}

	public Long getProjectId() {
		return projectId;
	}

	public void setProjectId(Long projectId) {
		this.projectId = projectId;
	}

	public static void main(String[] args) {
    	System.out.println(new Product().getCreated_on());
    	ObjectMapper mapper = new ObjectMapper();
    	try {
    	    String json = mapper.writeValueAsString(new Product());
    	    System.out.println(json);
    	} catch (IOException e) {
    	    e.printStackTrace();
    	}
	}
}
