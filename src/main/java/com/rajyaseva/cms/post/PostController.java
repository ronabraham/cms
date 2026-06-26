package com.rajyaseva.cms.post;

import java.sql.SQLException;

import javax.sql.DataSource;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.ApplicationContext;
import org.springframework.context.annotation.Bean;
import org.springframework.dao.DataAccessException;
import org.springframework.http.MediaType;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.namedparam.NamedParameterJdbcTemplate;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

import java.util.Collections;
import java.util.HashMap;
import java.util.Map;
import java.util.UUID;
import java.time.LocalDate;
import java.time.LocalDateTime;

@RestController
public class PostController {
	
	@Autowired
	ApplicationContext applicationContext;
	

	@Autowired
	NamedParameterJdbcTemplate namedParameterJdbcTemplate;
	
	@GetMapping("/")
	public String hello() {
		
		return "hello world";
	}
	
	
	@GetMapping("/{id}")
	public String printId(@PathVariable Long id) {
		
		String response = "Id is "+id+" displayName: "+this.applicationContext.getDisplayName();
		return response;
	}
	
	@RequestMapping(method = RequestMethod.POST, path = "/createPost",consumes = MediaType.APPLICATION_JSON_VALUE, produces = MediaType.APPLICATION_JSON_VALUE)
	public Post createPost(@RequestBody(required=true) Post requestBody) {
		

		String insertSQL2 = "insert into posts(id,title,created_date,timestamp,summary,detail) values "
				+ "(:id,:title,:date,:timestamp,:summary,:detail)";
		
		Map<String,String> namedParameters = new HashMap<>();
		namedParameters.put("id",UUID.randomUUID().toString() );
		namedParameters.put("title", requestBody.getTitle());
		namedParameters.put("date",LocalDate.now().toString());
		namedParameters.put("timestamp", LocalDateTime.now().toString());
		namedParameters.put("summary", requestBody.getPostSummary());
		namedParameters.put("detail", requestBody.getPostDetail());
		try {
			namedParameterJdbcTemplate.update(insertSQL2, namedParameters);
			
		} catch (DataAccessException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return requestBody;
			
	}
	
	private String quoteString(String arg){
			return "'"+arg+"'";
	}
}
