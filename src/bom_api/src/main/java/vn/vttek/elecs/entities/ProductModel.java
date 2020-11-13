package vn.vttek.elecs.entities;

import javax.persistence.*;
import java.io.Serializable;
import java.sql.Timestamp;

@Entity
@SequenceGenerator(name = "product_modelIdSeq", sequenceName = "product_model_id_seq", allocationSize=1)
public class ProductModel implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "product_modelIdSeq")
    private Long id;
    private int id_product;
    private int id_model;
    private int created_by_id;
    private Timestamp created_on;
    private int modified_by_id;
    private Timestamp modified_on;

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public int getId_product() {
        return id_product;
    }

    public void setId_product(int id_product) {
        this.id_product = id_product;
    }

    public int getId_model() {
        return id_model;
    }

    public void setId_model(int id_model) {
        this.id_model = id_model;
    }

    public int getCreated_by_id() {
        return created_by_id;
    }

    public void setCreated_by_id(int created_by_id) {
        this.created_by_id = created_by_id;
    }

    public Timestamp getCreated_on() {
        return created_on;
    }

    public void setCreated_on(Timestamp created_on) {
        this.created_on = created_on;
    }

    public int getModified_by_id() {
        return modified_by_id;
    }

    public void setModified_by_id(int modified_by_id) {
        this.modified_by_id = modified_by_id;
    }

    public Timestamp getModified_on() {
        return modified_on;
    }

    public void setModified_on(Timestamp modified_on) {
        this.modified_on = modified_on;
    }
}
