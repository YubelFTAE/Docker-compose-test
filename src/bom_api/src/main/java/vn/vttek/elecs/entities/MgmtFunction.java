package vn.vttek.elecs.entities;

import javax.persistence.*;
import java.io.Serializable;
import java.sql.Timestamp;

@Entity
@SequenceGenerator(name = "mgmt_functionIdSeq", sequenceName = "mgmt_fucntion_id_seq", allocationSize = 1)
public class MgmtFunction implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "mgmt_functionIdSeq")
    private Long id;
    private String name;
    private String remark;
    private Timestamp created_on;
    private String state;

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

    public String getRemark() {
        return remark;
    }

    public void setRemark(String remark) {
        this.remark = remark;
    }

    public Timestamp getCreated_on() {
        return created_on;
    }

    public void setCreated_on(Timestamp created_on) {
        this.created_on = created_on;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }
}
