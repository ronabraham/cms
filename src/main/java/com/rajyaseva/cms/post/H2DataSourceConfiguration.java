package com.rajyaseva.cms.post;

import org.springframework.boot.context.properties.ConfigurationProperties;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

@Configuration
public class H2DataSourceConfiguration {
	
	@Bean
	@ConfigurationProperties("spring.datasource")
	public H2DataSource h2dataSource(){
		return new H2DataSource();
	}

}
