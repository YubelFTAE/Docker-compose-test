package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.Department;

@Repository
public interface DepartmentRepository extends JpaRepository<Department, Long> {
	Boolean existsByName(String name);

	Boolean existsByCode(String code);
}
