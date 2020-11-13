package vn.vttek.elecs.model;

import java.util.ArrayList;
import java.util.List;

public class DeparmentModel {
	private Long id;
	private String title;
	private List<DeparmentModel> subs = new ArrayList<DeparmentModel>();

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public List<DeparmentModel> getSubs() {
		return subs;
	}

	public void setSubs(List<DeparmentModel> subs) {
		this.subs = subs;
	}

	public void addSubs(DeparmentModel model) {
		this.subs.add(model);
	}
}
