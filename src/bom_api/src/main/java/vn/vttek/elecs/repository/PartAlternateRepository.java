package vn.vttek.elecs.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import vn.vttek.elecs.entities.PartAlternate;

@Repository
public interface PartAlternateRepository extends JpaRepository<PartAlternate, Long> {

    @Query("SELECT alters FROM PartAlternate alters WHERE alters.source_id = :sourceId")
    List<PartAlternate> getListPartAlternateBySourceId(@Param("sourceId") Long sourceId);

    @Query(value = "SELECT related_id FROM PartAlternate p WHERE p.source_id IN :id")
    List<Long> findRelatedIdByPartId(Long id);

    @Query("SELECT alters FROM PartAlternate alters WHERE alters.source_id = :sourceId and alters.related_id In :relatedIds")
    List<PartAlternate> getListPartAlternate(@Param("sourceId") Long sourceId,
	    @Param("relatedIds") List<Long> relatedIds);
}
