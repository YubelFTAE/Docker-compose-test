package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.ProductModel;

@Repository
public interface ProductModelRepository extends JpaRepository<ProductModel, Long> {

}
