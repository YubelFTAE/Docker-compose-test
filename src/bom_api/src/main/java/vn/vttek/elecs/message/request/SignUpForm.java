package vn.vttek.elecs.message.request;

import org.hibernate.validator.constraints.Email;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Size;
import java.util.Set;

@SuppressWarnings("deprecation")
public class SignUpForm {
    @NotBlank
    @Size(min = 3, max = 50)
    private String name;
    @NotBlank
    @Size(min = 3, max = 50)
    private String username;
    @NotBlank
    @Size(max = 60)
    @Email
    private String email;
    private Set<String> role;
    @NotBlank
    @Size(min = 6, max = 40)
    private String password;
    private int group_id;
    private String phone;
    private String gender;
    private int identify_number;
    private String grand_permission;
    private String department_id;
    private String state;

    public String getName() {
	return name;
    }

    public void setName(String name) {
	this.name = name;
    }

    public String getUsername() {
	return username;
    }

    public void setUsername(String username) {
	this.username = username;
    }

    public String getEmail() {
	return email;
    }

    public void setEmail(String email) {
	this.email = email;
    }

    public String getPassword() {
	return password;
    }

    public void setPassword(String password) {
	this.password = password;
    }

    public Set<String> getRole() {
	return this.role;
    }

    public void setRole(Set<String> role) {
	this.role = role;
    }

    public String getGender() {
	return gender;
    }

    public void setGender(String gender) {
	this.gender = gender;
    }

    public int getIdentify_number() {
	return identify_number;
    }

    public void setIdentify_number(int identify_number) {
	this.identify_number = identify_number;
    }

    public String getGrand_permission() {
	return grand_permission;
    }

    public void setGrand_permission(String grand_permission) {
	this.grand_permission = grand_permission;
    }

    public String getDepartment_id() {
	return department_id;
    }

    public void setDepartment_id(String department_id) {
	this.department_id = department_id;
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

    public int getGroup_id() {
	return group_id;
    }

    public void setGroup_id(int group_id) {
	this.group_id = group_id;
    }
}