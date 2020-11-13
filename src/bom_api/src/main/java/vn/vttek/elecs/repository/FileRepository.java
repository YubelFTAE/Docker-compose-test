package vn.vttek.elecs.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import vn.vttek.elecs.entities.File;

@Repository
public interface FileRepository extends JpaRepository<File, Long> {

}
