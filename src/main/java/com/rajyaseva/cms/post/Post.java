package com.rajyaseva.cms.post;

import org.springframework.boot.persistence.autoconfigure.EntityScan;


public class Post {
	
	private String title;
	private String publishedDate ;
	private String postSummary;
	private String postDetail;
	
	public String getTitle() {
		return title;
	}
	public void setTitle(String title) {
		this.title = title;
	}
	public String getPublishedDate() {
		return publishedDate;
	}
	public void setPublishedDate(String publishedDate) {
		this.publishedDate = publishedDate;
	}
	public String getPostSummary() {
		return postSummary;
	}
	public void setPostSummary(String postSummary) {
		this.postSummary = postSummary;
	}
	public String getPostDetail() {
		return postDetail;
	}
	public void setPostDetail(String postDetail) {
		this.postDetail = postDetail;
	}


}
