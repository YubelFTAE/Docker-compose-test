package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import vn.vttek.elecs.entities.Account;

import java.util.Optional;

@Repository
public interface AccountRepository extends JpaRepository<Account, Long> {
	Optional<Account> findByUsername(String username);

	Boolean existsByUsername(String username);

	Boolean existsByEmail(String email);

	Account findByUsernameOrEmail(String username, String email);

	@Query("SELECT COUNT(a) FROM Account a WHERE a.department_id = :dep_id")
	Long countByDeparmentId(@Param("dep_id") String dep_id);

	@Query("SELECT COUNT(a) FROM Account a WHERE a.group_id = :id")
	Long countByGroupId(@Param("id") int id);
}