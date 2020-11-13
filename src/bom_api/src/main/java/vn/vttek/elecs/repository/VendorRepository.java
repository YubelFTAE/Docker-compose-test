package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.Vendor;

@Repository
public interface VendorRepository extends JpaRepository<Vendor, Long> {
	Boolean existsByName(String name);
}
