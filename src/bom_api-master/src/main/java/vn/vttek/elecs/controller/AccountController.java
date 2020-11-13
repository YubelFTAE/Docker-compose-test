package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.data.domain.Sort;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import vn.vttek.elecs.entities.Account;
import vn.vttek.elecs.entities.Role;
import vn.vttek.elecs.entities.RoleName;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.message.request.LoginForm;
import vn.vttek.elecs.message.request.SignUpForm;
import vn.vttek.elecs.message.response.JwtResponse;
import vn.vttek.elecs.message.response.LoginResponse;
import vn.vttek.elecs.repository.AccountRepository;
import vn.vttek.elecs.repository.RoleRepository;
import vn.vttek.elecs.security.jwt.JwtProvider;

import javax.validation.Valid;

import java.util.Arrays;
import java.util.Collections;
import java.util.Date;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

@RestController
@RequestMapping("/account")
public class AccountController {

	@Autowired
	AuthenticationManager authenticationManager;

	@Autowired
	AccountRepository accountRepository;

	@Autowired
	RoleRepository roleRepository;

	@Autowired
	JwtProvider jwtProvider;

	@PostMapping("/login")
	public LoginResponse login(@Valid @RequestBody LoginForm loginRequest) {
		LoginResponse resp = new LoginResponse();
		try {
//			Account account = accountRepository
//					.findByUsernameOrEmail(loginRequest.getUsernameOrEmail(), loginRequest.getUsernameOrEmail())
//					.orElseThrow(() -> new UsernameNotFoundException(
//							"User Not Found with -> username or email : " + loginRequest.getUsernameOrEmail()));

			Account account = accountRepository.findByUsernameOrEmail(loginRequest.getUsernameOrEmail(),
					loginRequest.getUsernameOrEmail());

			if (account == null) {
				resp.setError("USER_NOT_FOUND");
				resp.setStatus(false);
				return resp;
			}

			if (account.getPassword().equals(loginRequest.getPassword())) {
				resp.setStatus(true);
				resp.setId(account.getId().intValue());
				resp.setUsername(account.getUsername());
				resp.setFullname(account.getName());
				return resp;
			}
			resp.setError("PASSWORD_INCORRECT");
			resp.setStatus(false);
			return resp;
		} catch (Exception e) {
			System.err.println(e);
		}
		return resp;

//	Authentication authentication = authenticationManager.authenticate(
//		new UsernamePasswordAuthenticationToken(loginRequest.getUsernameOrEmail(), loginRequest.getPassword()));
//
//	SecurityContextHolder.getContext().setAuthentication(authentication);
//
//	String jwt = jwtProvider.generateJwtToken(authentication);
//	return ResponseEntity.ok(new JwtResponse(jwt));
	}

	@PostMapping("/addNewAccount")
	public ResponseEntity<String> createAccount(@Valid @RequestBody SignUpForm signUpRequest) {
		if (accountRepository.existsByUsername(signUpRequest.getUsername())) {
			return new ResponseEntity<String>("Fail -> Username is already taken!", HttpStatus.BAD_REQUEST);
		}

		if (accountRepository.existsByEmail(signUpRequest.getEmail())) {
			return new ResponseEntity<String>("Fail -> Email is already in use!", HttpStatus.BAD_REQUEST);
		}

		// Creating user's account
//	Account account = new Account(signUpRequest.getName(), signUpRequest.getUsername(), signUpRequest.getEmail(),
//		getEncoder().encode(signUpRequest.getPassword()));

		Account account = new Account(signUpRequest.getName(), signUpRequest.getUsername(), signUpRequest.getEmail(),
				signUpRequest.getPassword());

		Set<String> strRoles = signUpRequest.getRole();
		Set<Role> roles = new HashSet<>();

		if (strRoles == null) {
			return new ResponseEntity<String>("Fail -> Roles mustn't null!", HttpStatus.BAD_REQUEST);
		}

		strRoles.forEach(role -> {
			switch (role) {
			case "admin":
				Role adminRole = roleRepository.findByName(RoleName.ROLE_ADMIN)
						.orElseThrow(() -> new RuntimeException("Fail! -> Cause: User Role not find."));
				roles.add(adminRole);

				break;
			case "pm":
				Role pmRole = roleRepository.findByName(RoleName.ROLE_PM)
						.orElseThrow(() -> new RuntimeException("Fail! -> Cause: User Role not find."));
				roles.add(pmRole);

				break;
			default:
				Role userRole = roleRepository.findByName(RoleName.ROLE_USER)
						.orElseThrow(() -> new RuntimeException("Fail! -> Cause: User Role not find."));
				roles.add(userRole);
			}
		});

		account.setGroup_id(signUpRequest.getGroup_id());
		account.setPhone(signUpRequest.getPhone());
		account.setDepartment_id(signUpRequest.getDepartment_id());
		account.setGrand_permission(signUpRequest.getGrand_permission());
		account.setGender(signUpRequest.getGender());
		account.setState(signUpRequest.getState());
		account.setRoles(roles);
		account.setCreated_on(new Date());
		account.setIdentify_number(signUpRequest.getIdentify_number());

		accountRepository.save(account);
		return ResponseEntity.ok().body("User registered successfully!");
	}

	@PutMapping("/updateInfoAccount/{accountId}")
	public Account updateAccount(@PathVariable Long accountId, @RequestBody SignUpForm signUpRequest) {
		Set<String> strRoles = signUpRequest.getRole();
		Set<Role> roles = new HashSet<>();

		strRoles.forEach(role -> {
			switch (role) {
			case "admin":
				Role adminRole = roleRepository.findByName(RoleName.ROLE_ADMIN)
						.orElseThrow(() -> new RuntimeException("Fail! -> Cause: User Role not find."));
				roles.add(adminRole);

				break;
			case "pm":
				Role pmRole = roleRepository.findByName(RoleName.ROLE_PM)
						.orElseThrow(() -> new RuntimeException("Fail! -> Cause: User Role not find."));
				roles.add(pmRole);

				break;
			default:
				Role userRole = roleRepository.findByName(RoleName.ROLE_USER)
						.orElseThrow(() -> new RuntimeException("Fail! -> Cause: User Role not find."));
				roles.add(userRole);
			}
		});

		return accountRepository.findById(accountId).map(account -> {
			account.setName(signUpRequest.getName());
			account.setEmail(signUpRequest.getEmail());
			account.setGroup_id(signUpRequest.getGroup_id());
			account.setPhone(signUpRequest.getPhone());
			account.setDepartment_id(signUpRequest.getDepartment_id());
			account.setGrand_permission(signUpRequest.getGrand_permission());
			account.setGender(signUpRequest.getGender());
			account.setState(signUpRequest.getState());
			account.setRoles(roles);
			account.setIdentify_number(signUpRequest.getIdentify_number());
			return accountRepository.save(account);
		}).orElseThrow(() -> new ResourceNotFoundException("Account not found with id " + accountId));
	}

	@DeleteMapping("/deleteAccount/{id}")
	public ResponseEntity<?> deleteAccount(@PathVariable Long id) {
		return accountRepository.findById(id).map(account -> {
			accountRepository.delete(account);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("Acount not found with id " + id));
	}

	@RequestMapping(path = "/getListAccount", method = RequestMethod.GET)
	public List<Account> getListAccount(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<Account> accs = accountRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return accs;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Account[] { accountRepository.findById(longId).get() });
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}

	}

	@RequestMapping(path = "/checkExistAccount", method = RequestMethod.GET)
	public Boolean checkPartCode(@RequestParam String username) {
		if (username == null) {
			System.err.println("username mustn't null");
			return null;
		}
		try {
			return accountRepository.existsByUsername(username);
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@RequestMapping(path = "/getNameById", method = RequestMethod.GET)
	public String getNameById(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			long longId = Long.parseLong(id);
			return accountRepository.findById(longId).map(acc -> {
				return acc.getUsername();
			}).orElseThrow(() -> new ResourceNotFoundException("Account not found with id " + longId));
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@Bean
	PasswordEncoder getEncoder() {
		return new BCryptPasswordEncoder();
	}
}