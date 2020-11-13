package vn.vttek.elecs.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import vn.vttek.elecs.entities.GroupUser;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.AccountRepository;
import vn.vttek.elecs.repository.GroupUserRepository;

import java.util.Arrays;
import java.util.List;

import javax.validation.Valid;

@RestController
@RequestMapping("/gr_account")
public class GroupUserController {

	@Autowired
	private GroupUserRepository groupuserRepository;

	@Autowired
	private AccountRepository accountRepository;

	@GetMapping("/getListGroupAccPage")
	public Page<GroupUser> getGroupUser(Pageable pageable) {
		return (Page<GroupUser>) groupuserRepository.findAll();
	}

	@RequestMapping(path = "/getListGroupAcc", method = RequestMethod.GET)
	public List<GroupUser> getListGroupAcc(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			List<GroupUser> groups = groupuserRepository.findAll(Sort.by(Sort.Direction.DESC, "id"));
			return groups;
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new GroupUser[] { groupuserRepository.findById(longId).get() });
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}
	}

	@PostMapping("/addNewGroupAcc")
	public ResponseEntity<String> createGroupUser(@Valid @RequestBody GroupUser groupuser) {
		if (groupuserRepository.existsByName(groupuser.getName())) {
			return new ResponseEntity<String>("NAME_EXISTED", HttpStatus.BAD_REQUEST);
		}

		groupuserRepository.save(groupuser);
		return ResponseEntity.ok().body("Create group user successfully!");
	}

	@PutMapping("/updateInfoGroupAcc/{groupuserId}")
	public GroupUser updateGroupUser(@PathVariable Long groupuserId, @Valid @RequestBody GroupUser groupuserRequest) {
		return groupuserRepository.findById(groupuserId).map(groupuser -> {
			groupuser.setPermission(groupuserRequest.getPermission());
			groupuser.setName(groupuserRequest.getName());
			groupuser.setModified_on(groupuser.getModified_on());

			return groupuserRepository.save(groupuser);
		}).orElseThrow(() -> new ResourceNotFoundException("groupuser not found with id " + groupuserId));
	}

	@DeleteMapping("/deleteGroupAcc/{groupuserId}")
	public ResponseEntity<?> deleteGroupUser(@PathVariable Long groupuserId) {
		if (accountRepository.countByGroupId(groupuserId.intValue()) > 0) {
			return new ResponseEntity<String>("GROUPUSER_USED", HttpStatus.BAD_REQUEST);
		}
		return groupuserRepository.findById(groupuserId).map(groupuser -> {
			groupuserRepository.delete(groupuser);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("groupuser not found with id " + groupuserId));
	}

	@RequestMapping(path = "/checkGroupUserName", method = RequestMethod.GET)
	public Boolean checkGroupUserName(@RequestParam String name) {
		return groupuserRepository.existsByName(name);
	}
}
