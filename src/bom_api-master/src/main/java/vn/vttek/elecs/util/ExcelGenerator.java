package vn.vttek.elecs.util;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.CellStyle;
import org.apache.poi.ss.usermodel.Font;
import org.apache.poi.ss.usermodel.HorizontalAlignment;
import org.apache.poi.ss.usermodel.IndexedColors;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

public class ExcelGenerator {
    public static ByteArrayInputStream customersToExcel(String array[][], String array1[][]) throws IOException {
	try (Workbook workbook = new XSSFWorkbook(); ByteArrayOutputStream out = new ByteArrayOutputStream();) {
	    Sheet sheet = workbook.createSheet("Excel");
	    sheet.setDefaultColumnWidth(20);

	    int rowIdx = 0;

	    if (array1.length > 0) {
		for (int i = 0; i < array1.length; i++) {
		    Row row = sheet.createRow(rowIdx++);
		    for (int j = 0; j < array1[i].length; j++) {
			row.createCell(j).setCellValue(array1[i][j]);
		    }
		}
		sheet.createRow(rowIdx++);
	    }

	    Font headerFont = workbook.createFont();
	    headerFont.setBold(true);
	    headerFont.setColor(IndexedColors.BLUE.getIndex());

	    CellStyle headerCellStyle = workbook.createCellStyle();
	    headerCellStyle.setAlignment(HorizontalAlignment.CENTER);
	    headerCellStyle.setFont(headerFont);

	    // Row for Header
	    Row headerRow = sheet.createRow(rowIdx++);

	    // Header
	    for (int colIdx = 0; colIdx < array[0].length; colIdx++) {
		Cell cell = headerRow.createCell(colIdx);
		cell.setCellValue(array[0][colIdx]);
		cell.setCellStyle(headerCellStyle);
	    }

	    for (int i = 1; i < array.length; i++) {
		Row row = sheet.createRow(rowIdx++);
		for (int j = 0; j < array[i].length; j++) {
		    row.createCell(j).setCellValue(array[i][j]);
		}
	    }

	    workbook.write(out);
	    return new ByteArrayInputStream(out.toByteArray());
	}
    }
}
