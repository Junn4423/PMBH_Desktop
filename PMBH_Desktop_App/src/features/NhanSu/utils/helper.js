  export const formatDate = (dateString?: string): string => {
    if (!dateString) return 'Không có thông tin';
  
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return 'Ngày không hợp lệ';
  
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
  
    return `${day}/${month}/${year}`;
  };

  export const formatDateFromDate = (date: Date): string => {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
  
    return `${day}/${month}/${year}`;
  };

  export const parseDateFromString = (dateString: string): Date | null => {
    const [day, month, year] = dateString.split('/').map(Number);
    const parsedDate = new Date(year, month - 1, day); // tháng bắt đầu từ 0
    return isNaN(parsedDate.getTime()) ? null : parsedDate;
  };
  
  export const displayValue = (value: string | null | undefined, isDate = false): string => {
    if (!value) return 'Không có thông tin';
    return isDate ? formatDate(value) : value;
  };
  