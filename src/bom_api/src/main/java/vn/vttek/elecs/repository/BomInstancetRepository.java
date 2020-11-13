package vn.vttek.elecs.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import vn.vttek.elecs.entities.BomInstance;

@Repository
public interface BomInstancetRepository extends JpaRepository<BomInstance, Long> {

	@Query("SELECT instance FROM BomInstance instance WHERE instance.source_id = :sourceId")
    List<BomInstance> getListBomInstanceBySourceId(@Param("sourceId") Long sourceId);
}
