package vn.vttek.elecs.repository;

import java.util.List;
import java.util.Set;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import vn.vttek.elecs.entities.Part;

@Repository
public interface PartRepository extends JpaRepository<Part, Long> {
    @Query("SELECT p FROM Part p WHERE p.id IN (SELECT id_part_number FROM Model m WHERE m.id = :modelId)")
    List<Part> getInfoPartByModelId(@Param("modelId") Long modelId);

    @Query("SELECT COUNT(p) FROM Part p WHERE p.item_number = :part_number")
    Long countByItemNumber(@Param("part_number") String part_number);

    @Query("SELECT item_number FROM Part p WHERE p.id = :part_id")
    String getPartNumberById(@Param("part_id") Long part_id);

    @Query("SELECT p FROM Part p WHERE p.id IN (SELECT pb.related_id FROM PartBom pb WHERE pb.source_id = :part_id)")
    List<Part> getPartBom(@Param("part_id") Long part_id);

    @Query("SELECT p FROM Part p WHERE p.id IN (SELECT pa.related_id FROM PartAlternate pa WHERE pa.source_id = :part_id)")
    List<Part> getPartAltenative(@Param("part_id") Long part_id);

    @Query("SELECT p FROM Part p WHERE p.id IN (SELECT bi.related_id FROM PartBuy bi WHERE bi.source_id = :part_id)")
    List<Part> getPartBuy(@Param("part_id") Long part_id);

    @Query("SELECT config_id FROM Part p WHERE p.id = :part_id")
    Long getConfigId(@Param("part_id") Long part_id);

    @Query(value = "SELECT p FROM Part p WHERE p.manufacturer_id IN :manu_id")
    List<Part> findPartOfManu(Long manu_id);

    @Query(value = "SELECT p.id FROM Part p WHERE p.item_number IN :itemNumber")
    List<Long> findIdByItemNumber(Set<String> itemNumber);

    @Query(value = "SELECT MAX(p.version) FROM Part p WHERE p.item_number = :itemNumber")
    Long findMaxVersionByItemNumber(String itemNumber);

    @Query(value = "SELECT p FROM Part p WHERE p.item_number = :itemNumber")
	List<Part> findPartByItemNumber(String itemNumber);
}
