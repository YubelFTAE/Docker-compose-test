package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.GroupUser;

@Repository
public interface GroupUserRepository extends JpaRepository<GroupUser, Long> {
	Boolean existsByName(String name);
}
