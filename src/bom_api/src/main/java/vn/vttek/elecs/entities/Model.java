package vn.vttek.elecs.entities;

import javax.persistence.*;

import com.fasterxml.jackson.databind.ObjectMapper;

import java.io.IOException;
import java.io.Serializable;
import java.sql.Timestamp;

@Entity
@SequenceGenerator(name = "modelIdSeq", sequenceName = "model_id_seq", allocationSize=1)
public class Model implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "modelIdSeq")
    private Long id;
    private Long id_part_number;
    private String item_number;
    private String name;
    private String description;
    private String version_number;
    private String release_number;
    private Long created_by_id;
    private Long product_id;
    private Timestamp created_on;
    private Long modified_by_id;
    private Timestamp modified_on;

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getId_part_number() {
        return id_part_number;
    }

    public void setId_part_number(Long id_part_number) {
        this.id_part_number = id_part_number;
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

    public String getVersion_number() {
        return version_number;
    }

    public void setVersion_number(String version_number) {
        this.version_number = version_number;
    }

    public String getRelease_number() {
        return release_number;
    }

    public void setRelease_number(String release_number) {
        this.release_number = release_number;
    }

    public Long getCreated_by_id() {
        return created_by_id;
    }

    public void setCreated_by_id(Long created_by_id) {
        this.created_by_id = created_by_id;
    }

	public Long getProduct_id() {
		return product_id;
	}

	public void setProduct_id(Long product_id) {
		this.product_id = product_id;
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

	public static void main(String[] args) {
    	ObjectMapper mapper = new ObjectMapper();
    	try {
    	    String json = mapper.writeValueAsString(new Model());
    	    System.out.println(json);
    	} catch (IOException e) {
    	    e.printStackTrace();
    	}
	}
}
