package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import vn.vttek.elecs.entities.Product;

@Repository
public interface ProductRepository extends JpaRepository<Product, Long> {
	@Query("SELECT COUNT(p) FROM Product p WHERE p.item_number = :itemNumber")
    Long countByItemNumber(@Param("itemNumber") String itemNumber);

	@Transactional
	@Modifying(clearAutomatically = true)
	@Query("UPDATE Product p SET p.lock = :lock WHERE p.id = :id")
    int updateStateLock(@Param("lock") Short lock, @Param("id") Long id);
}
