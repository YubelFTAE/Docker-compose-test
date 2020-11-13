package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.Document;

@Repository
public interface DocumentRepository extends JpaRepository<Document, Long> {
	Boolean existsByName(String name);
}
