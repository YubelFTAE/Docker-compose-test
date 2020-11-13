package vn.vttek.elecs.security;

import javax.sql.DataSource;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.EnableAutoConfiguration;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.method.configuration.EnableGlobalMethodSecurity;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;

@Configuration
@EnableWebSecurity
@EnableGlobalMethodSecurity(prePostEnabled = true)
@EnableAutoConfiguration
public class SecurityConfig extends WebSecurityConfigurerAdapter {

    
    
    @Autowired
    DataSource dataSource;
   
    @Override
	protected void configure(HttpSecurity http) throws Exception {
                http.csrf().disable();
		http.authorizeRequests().antMatchers("/","/index","/css/**","/js/**","/img/**","/register","/login","/user").permitAll()
                                        .antMatchers("/welcome/**","/product/**", "/model/**", "/part/**", "/partbom/**","/product/delete/**", "/department/**", "/account/**", "/gr_account/**", "/manufacturer/**",  "/document/**",  "/file/**",  "/vendor/**").permitAll()
                                        //.hasRole("ADMIN")
                                        .anyRequest().authenticated()
                                        .and()
                                        .formLogin().loginPage("/login").defaultSuccessUrl("/books")
                                        .and()
                                        .logout()
                                        .permitAll();
	}


    @Autowired
    public void configAuthentication(AuthenticationManagerBuilder auth) throws Exception {
        auth.jdbcAuthentication().dataSource(dataSource)
                .usersByUsernameQuery("select username,password, enabled from users where username=?")
                .authoritiesByUsernameQuery("select username, role from user_roles where username=?");
                

    }
    @Override
    @Bean
    public AuthenticationManager authenticationManagerBean() throws Exception {
        return super.authenticationManagerBean();
    }
}

