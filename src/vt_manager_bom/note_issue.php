1. Khi thêm part bom từ file -> chưa mặc định trương version giá trị 1
2. Clone part nhưng cấu trúc bom không clone theo -> critical
3. Clone part version = max + 1
4. Check trùng mã part khi thêm part bom từ file 
5. Khi thêm part bom/thay thế/ mua từ file - Không cho phép thêm mã part là chính nó (tự động cancel)
6. Khi thêm mới part bom từ file - cần call api số 7 (Tab API-BOM-MANUFACTURER)
-> Truyên vào tên nha sản xuất để nhận về id
7. Chuẩn hóa lại dữ liệu lưu đúng vào bảng part buy khi thêm part buy từ UI

===============
1. check lại api get part buy
2. Truyền sai trường dữ liệu nhà sản xuất khi thêm mới part bom từ file

===========================================================================
1. update thông tin model -> chưa được: check api: ../model/updateInfoModel/
2. upgrate api xóa quan hệ part: partbom/deletePartRelationShip
-> Hiện tại mới chỉ xóa quan hệ part bom -> Giơ muốn truyên thêm type -> để thực hiện xóa được cả part alternate và part buy

====================
chua cap nhat dc so luong part khi sua

