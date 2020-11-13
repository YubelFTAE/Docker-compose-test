package vn.vttek.elecs.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import vn.vttek.elecs.entities.PartBom;

@Repository
public interface PartBomRepository extends JpaRepository<PartBom, Long> {
    @Query("SELECT bom FROM PartBom bom WHERE bom.source_id = :sourceId")
    List<PartBom> getListPartBomBySourceId(@Param("sourceId") Long sourceId);

    @Query(value = "SELECT related_id FROM PartBom p WHERE p.source_id IN :id")
    List<Long> findRelatedIdByPartId(Long id);

    @Query("SELECT bom FROM PartBom bom WHERE bom.source_id = :sourceId and bom.related_id In :relatedIds")
    List<PartBom> getListPartBom(@Param("sourceId") Long sourceId, @Param("relatedIds") List<Long> relatedIds);
}
