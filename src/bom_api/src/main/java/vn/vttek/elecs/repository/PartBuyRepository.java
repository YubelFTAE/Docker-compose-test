package vn.vttek.elecs.repository;

import java.util.List;

import org.springframework.data.domain.Sort.Order;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import vn.vttek.elecs.entities.PartBuy;

@Repository
public interface PartBuyRepository extends JpaRepository<PartBuy, Long> {
    @Query("SELECT buy FROM PartBuy buy WHERE buy.source_id = :sourceId")
    List<PartBuy> getListPartBuyBySourceId(@Param("sourceId") Long sourceId);

    @Query(value = "SELECT related_id FROM PartBuy p WHERE p.source_id IN :id")
    List<Long> findRelatedIdByPartId(Long id);

    @Query("SELECT buys FROM PartBuy buys WHERE buys.source_id = :sourceId and buys.related_id In :relatedIds")
    List<PartBuy> getListPartBuy(@Param("sourceId") Long sourceId, @Param("relatedIds") List<Long> relatedIds);

}
