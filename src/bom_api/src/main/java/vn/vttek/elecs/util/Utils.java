package vn.vttek.elecs.util;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.sql.Timestamp;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Date;
import java.util.Iterator;
import java.util.List;
import java.util.Set;

import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.CellType;
import org.apache.poi.ss.usermodel.DataFormatter;
import org.apache.poi.ss.usermodel.FormulaEvaluator;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.ser.FilterProvider;
import com.fasterxml.jackson.databind.ser.impl.SimpleBeanPropertyFilter;
import com.fasterxml.jackson.databind.ser.impl.SimpleFilterProvider;

import vn.vttek.elecs.entities.Part;

public class Utils {
    public static final String ROLE_UP_TREE_COLUMN[] = { "Mã Part", "Tên", "Số Lượng", "Giá", "Thành Tiền" };
    public static final String ROLE_UP_TREE_ROW[][] = { { "Mã Part", "" }, { "Tên", "" }, { "Số Lượng", "" } };
    public static final String PART_BOM_COLUMN[] = { "TT", "Mô tả\n" + "(Description/Spec)",
	    "Chủng loại\n" + "(Category)", "Type", "NSX tham khảo 1", "Mã NSX tham khảo 1", "NSX tham khảo 2",
	    "Mã NSX tham khảo 2", "NSX tham khảo 3", "Mã NSX tham khảo 3", "Số lượng", "Đơn vị tính", "Location",
		"Đơn giá tham khảo", "Số NSX đáp ứng", "Ghi chú" };
	public static final String PART_BOM_HEADER[][] = {
		{ "Model cơ bản\r\n" + "(Basic Model)", "VSI3", "Màu sắc vỏ (Color):", "" },
		{ "Tên của model\r\n" + "(Customer model)", "VTLK BO MẠCH RF", "Phiên bản phần cứng (HW Version):", "" } };

    public static void main(String[] args) {
//		String fileName = "/home/vttek/Downloads/EBOM theo mau.xlsx";
//		File file = new File(fileName);
//	    byte[] encoded;
//		try {
//			encoded = Base64.getEncoder().encode(FileUtils.readFileToByteArray(file));
//			String based64 = new String(encoded, StandardCharsets.US_ASCII);
//			System.out.println(based64);
//			InputStream stream = new ByteArrayInputStream(Base64.getDecoder().decode(based64.getBytes()));
//			List<Part> list = Utils.readRawBom(stream, 1L, 1L);
//			System.out.println(Utils.toJson(list.get(0)));
//		} catch (IOException e1) {
//			e1.printStackTrace();
//		}
		
		Part part = new Part();
		System.out.println(toJson(part));
	}
	
	public static String toJson(Object object) {
		ObjectMapper mapper = new ObjectMapper();
		BufferedWriter bw = null;
		try {
			SimpleBeanPropertyFilter theFilter = SimpleBeanPropertyFilter
					.filterOutAllExcept(new String[] { "id", "children", "level" });
			FilterProvider filters = new SimpleFilterProvider().addFilter("myFilter", theFilter);
			String json = mapper
//					.writer(filters).withDefaultPrettyPrinter()
    	    		.writerWithDefaultPrettyPrinter()
					.writeValueAsString(object);
			bw = new BufferedWriter(new FileWriter(new File("json.txt")));
			bw.append(json);
			return json;
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			try {
				bw.close();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		return "";
	}
	
	public static List<Part> readRawBom(InputStream stream, Long partId, Long createById, Set<String> itemNumber) throws IOException {
		if (partId == null || createById == null) {
			return new ArrayList<>();
		}
		List<Part> ret = new ArrayList<Part>();
		// Đọc một file XSL.
		// Đối tượng workbook cho file XSL.
		Workbook workbook = new XSSFWorkbook(stream);
		// Lấy ra sheet đầu tiên từ workbook
		XSSFSheet sheet = (XSSFSheet) workbook.getSheetAt(0);
		// Lấy ra Iterator cho tất cả các dòng của sheet hiện tại.
		int rowNum = 0;
		Iterator<Row> rowIterator = sheet.iterator();
		while (rowIterator.hasNext()) {
			Row row = rowIterator.next();
			++rowNum;
			if (rowNum < 8) {
				continue;
			}
			int colNum = 0;
			Iterator<Cell> cellIterator = row.cellIterator();
			Part part = new Part();
			boolean isEnd = false;
			String name1 = null, name2 = null, name3 = null, code1 = null, code2 = null, code3 = null;
			while (cellIterator.hasNext()) {
				++colNum;
				Cell cell = cellIterator.next();
				String value = getValueCell(cell);
				if (value == null || value.isEmpty()) 
					continue;
				switch (colNum) {
				case 1: // STT
					try {
						Double.parseDouble(value);
					} catch (NumberFormatException e) {
						isEnd = true;
					}
					break;
				case 2: // Description
					part.setDescription(value);
					break;
				case 3: // Category
					part.setCategory(value);
					break;
				case 4: // Type == Category 
					part.setExternal_type(value);
					break;
				case 5: // NSX tham khảo 1
					name1 = getValueCell(cell);
					break;
				case 6: // Mã NSX tham khảo 1
					code1 = getValueCell(cell);
					break;
				case 7: // NSX tham khảo 2
					name2 = getValueCell(cell);
					break;
				case 8: // Mã NSX tham khảo 2
					code2 = getValueCell(cell);
					break;
				case 9: // NSX tham khảo 3
					name3 = getValueCell(cell);
					break;
				case 10: // Mã NSX tham khảo 3
					code3 = getValueCell(cell);
					break;
				case 11: // Số lượng
					part.setQuantity((long) Double.parseDouble(value));
					break;
				case 12: // Đơn vị tính
					part.setUnit(value);
					break;
				case 13: // Location
					part.setReference_designator(value);
					break;
				case 14: // "Đơn giá tham khảo(VNĐ)"
//					part.setCost_basis(Double.parseDouble(value));
					break;
				case 15: // "Thành tiền(Đã bao gồm các loại thuế phí, VAT)(VNĐ)"
					part.setCost(Double.parseDouble(value));
					break;
				case 16: // Số NSX đáp ứng
					part.setNumber_manufacturer_res((long) Double.parseDouble(value));
					break;
				case 17: // "Thời gian cung cấp hàng hóa(Leadtime)"
					SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
					try {
						Date date = sdf.parse(value);
						part.setLead_time(new Timestamp(date.getTime()));
					} catch (Exception e) {
						e.printStackTrace();
					}
					break;
				case 18: // Ghi chú
					part.setNote(value);
					break;
				case 19: // "Loại (1 - Chắc chắn, 2 - Chưa chắc chắn)"
					part.setIs_sure((long) Double.parseDouble(value));
					break;
				case 20: // Tăng/ giảm số lượng
					part.setAdjust_quantity(value);
					break;
				case 21: // Kiểu cách đóng gói
					part.setPacking(value);
					break;
				default:
					break;
				}
				if (isEnd)
					break;
			}
			part.setGeneration(1L);
			part.setCreated_on(new Timestamp(System.currentTimeMillis()));
			part.setCreated_by_id(createById);
			Part bom = part.clone();
			if (bom == null) {
				continue;
			}
			if (name1 != null && code1 != null) {
				bom.setManufacturer(name1);
				bom.setItem_number(code1);
				bom.setOffsetManufacturer(1);
				ret.add(bom);
				itemNumber.add(code1);
			}
			if (name2 != null && code2 != null) {
				Part alterOne = part.clone();
				if (alterOne == null) {
					continue;
				}
				alterOne.setManufacturer(name2);
				alterOne.setItem_number(code2);
				alterOne.setOffsetManufacturer(2);
				ret.add(alterOne);
				itemNumber.add(code2);
			}
			if (name3 != null && code3 != null) {
				Part alterTwo = part.clone();
				if (alterTwo == null) {
					continue;
				}
				alterTwo.setManufacturer(name3);
				alterTwo.setItem_number(code3);
				alterTwo.setOffsetManufacturer(3);
				ret.add(alterTwo);
				itemNumber.add(code3);
			}
//			System.out.println("");
		}
		workbook.close();
		return ret;
	}
	
	private static String getValueCell(Cell cell) {
		CellType cellType = cell.getCellType();
		if (CellType.FORMULA.equals(cellType)) {
			FormulaEvaluator evaluator;
			try {
				evaluator = cell.getSheet().getWorkbook().getCreationHelper().createFormulaEvaluator();
				cell.setCellValue(evaluator.evaluate(cell).getStringValue());
			} catch (Exception e) {
				evaluator = cell.getSheet().getWorkbook().getCreationHelper().createFormulaEvaluator();
				try {
					switch(cell.getCachedFormulaResultType()) {
		            case STRING:
		                cell.setCellValue(cell.getStringCellValue());
		                break;
		            case NUMERIC:
		            	cell.setCellValue(cell.getNumericCellValue() + "");
		                break;
		            case ERROR:
		            	cell.setCellValue("");
		                break;
					default:
						break;
					}
				} catch (Exception e1) {
					cell.setCellValue("");
					return null;
				}
			}
		} else {
			DataFormatter formatter = new DataFormatter();
			cell.setCellValue(formatter.formatCellValue(cell));
		}
//		System.out.println(cell.getStringCellValue());
		return cell.getStringCellValue();
	}
}
