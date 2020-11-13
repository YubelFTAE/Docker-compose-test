package vn.vttek.elecs.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import vn.vttek.elecs.entities.Model;

@Repository
public interface ModelRepository extends JpaRepository<Model, Long> {
	@Query("SELECT COUNT(m) FROM Model m WHERE m.item_number = :itemNumber")
    Long countByItemNumber(@Param("itemNumber") String itemNumber);
	
	@Query("SELECT m FROM Model m WHERE m.product_id = :productId")
    List<Model> getListModelByProId(@Param("productId") Long productId);
	
	@Transactional
	@Modifying(clearAutomatically = true)
	@Query("UPDATE Model m SET m.id_part_number = :partId WHERE m.id = :modId")
    int changePartOfModel(@Param("partId") Long partId, @Param("modId") Long modId);
}
