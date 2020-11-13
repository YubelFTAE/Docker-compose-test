package vn.vttek.elecs.controller;

import java.util.Arrays;
import java.util.List;
import java.util.NoSuchElementException;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.data.domain.Sort.Direction;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import vn.vttek.elecs.entities.Model;
import vn.vttek.elecs.entities.Product;
import vn.vttek.elecs.exception.ResourceNotFoundException;
import vn.vttek.elecs.repository.ProductRepository;

@RestController
public class ProductController {
	@Autowired
	private ProductRepository productRepository;

	@GetMapping("/product")
	public Page<Product> getProduct(Pageable pageable) {
		return (Page<Product>) productRepository.findAll(new Sort(Direction.DESC, new String[] {"id"}));
	}

	@PostMapping("/product")
	public Product createProduct(@Valid @RequestBody Product product) {
		return productRepository.save(product);
	}

	@PutMapping("/product/{productId}")
	public Product updateQuestion(@PathVariable Long productId, @Valid @RequestBody Product productRequest) {
		return productRepository.findById(productId).map(product -> {
			product.setItem_number(productRequest.getItem_number());
			product.setName(productRequest.getName());
			product.setDescription(productRequest.getDescription());
			product.setCreated_by_id(productRequest.getCreated_by_id());
			product.setModified_by_id(productRequest.getModified_by_id());
			product.setModified_on(productRequest.getModified_on());
			product.setState(productRequest.getState());
			product.setProjectId(productRequest.getProjectId());

			return productRepository.save(product);
		}).orElseThrow(() -> new ResourceNotFoundException("product not found with id " + productId));
	}

	@DeleteMapping("/product/{productId}")
	public ResponseEntity<?> deleteProduct(@PathVariable Long productId) {
		return productRepository.findById(productId).map(product -> {
			productRepository.delete(product);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("product not found with id " + productId));
	}

	@RequestMapping(path = "/product/getListProduct", method = RequestMethod.GET)
	public List<Product> getListProduct(@RequestParam String id) {
		if (id == null || id.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		if ("*".equals(id)) {
			return productRepository.findAll(new Sort(Direction.DESC, new String[] {"id"}));
		} else {
			try {
				long longId = Long.parseLong(id);
				return Arrays.asList(new Product[] { productRepository.findById(longId).get() });
			} catch (java.lang.NumberFormatException e) {
				System.err.println(e);
			} catch (Exception e) {
				System.err.println(e);
			}
			return null;
		}

	}

	@PostMapping("/product/addNewProduct")
	public Boolean addNewProduct(@Valid @RequestBody Product product) {
		if (product == null) {
			System.err.println("product mustn't null");
			return null;
		}
		try {
			return productRepository.save(product) == null ? false : true;
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}

	@RequestMapping(path = "/product/checkProductNumber", method = RequestMethod.GET)
	public Boolean checkProductNumber(@RequestParam String pro_number) {
		if (pro_number == null || pro_number.isEmpty()) {
			System.err.println("id mustn't null");
			return null;
		}
		try {
			return productRepository.countByItemNumber(pro_number) > 0L ? true : false;
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;

	}

	@PutMapping("/product/updateStateLock/{pro_id}/{lock}")
	public Boolean updateStateLock(@PathVariable Long pro_id, @Valid @PathVariable Short lock) {
		if (pro_id == null || lock == null) {
			System.err.println("pro_id and lock mustn't null");
			return null;
		}
		try {
			return productRepository.updateStateLock(lock, pro_id) > 0L ? true : false;
		} catch (Exception e) {
			System.err.println(e);
		}
		return null;
	}
	
	@DeleteMapping("/product/deleteProduct/{pro_id}")
	public ResponseEntity<?> deleteProduct1(@PathVariable Long pro_id) {
		return productRepository.findById(pro_id).map(product -> {
			productRepository.delete(product);
			return ResponseEntity.ok().build();
		}).orElseThrow(() -> new ResourceNotFoundException("product not found with id " + pro_id));
	}
	
	@PutMapping("/product/updateProduct/{product_id}")
    public Boolean updateProduct(@PathVariable Long product_id,
                             @Valid @RequestBody Product product) {
		if (product_id == null || product == null) {
			System.err.println("mod_id and model mustn't null");
			return null;
		}
		Product p;
		try {
			p = productRepository.findById(product_id).get();
		} catch (NoSuchElementException e) {
			System.err.println("cann't found mod_id: " + product_id);
			return null;
		}
    	p.setDescription(product.getDescription());
    	p.setItem_number(product.getItem_number());
    	p.setLock(product.getLock());
    	p.setModified_by_id(product.getModified_by_id());
    	p.setModified_on(product.getModified_on());
    	p.setName(product.getName());
    	p.setState(product.getState());
    	p.setProjectId(product.getProjectId());
    	return productRepository.save(p) == null ? false : true;
    }
}
