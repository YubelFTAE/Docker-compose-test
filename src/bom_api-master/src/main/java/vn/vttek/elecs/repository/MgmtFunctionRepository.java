package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.MgmtFunction;

@Repository
public interface MgmtFunctionRepository extends JpaRepository<MgmtFunction, Long> {

}
