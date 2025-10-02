import React, { useState, useEffect, useMemo, useCallback } from 'react';
import { Card, Breadcrumb, Button, Table, DatePicker, Space, Statistic, Row, Col, message, Spin, Select } from 'antd';
import { BarChart, Calendar, Download, Table2, TrendingUp } from 'lucide-react';
import dayjs from 'dayjs';
import { layBaoCaoBanHangChiTiet, layBaoCaoBanHangHomNay, layBaoCaoBanHangTuanNay, xuatBaoCaoBanHang } from '../../services/apiServices';
import './BaoCaoDoanhThuKhachHang.css';

const { RangePicker } = DatePicker;
const { Option } = Select;

const BaoCaoDoanhThuKhachHang = () => {
  const [loading, setLoading] = useState(false);
  const [data, setData] = useState([]);
  const [summary, setSummary] = useState({
    tongThanhTien: 0,
    soNgay: 0,
    tongSanPham: 0
  });
  const DATE_FORMAT = 'YYYY-MM-DD';
  const DISPLAY_FORMAT = 'DD/MM/YYYY';

  const [period, setPeriod] = useState({
    from: '',
    to: ''
  });
  const [selectedRange, setSelectedRange] = useState({
    start: null,
    end: null
  });
  const [quickFilter, setQuickFilter] = useState('today');
  const [reportType, setReportType] = useState('table');
  const [isPickerOpen, setIsPickerOpen] = useState(false);

  useEffect(() => {
    const todayString = dayjs().format(DATE_FORMAT);
    setSelectedRange({ start: todayString, end: todayString });
    loadDataByFilter('today');
  }, []);

  const rangePickerValue = useMemo(() => {
    const startMoment = selectedRange.start ? dayjs(selectedRange.start) : null;
    const endMoment = selectedRange.end ? dayjs(selectedRange.end) : null;
    if (!startMoment && !endMoment) {
      return [];
    }
    return [startMoment, endMoment];
  }, [selectedRange]);

  const loadDataByFilter = async (filterType) => {
    try {
      setLoading(true);
      setQuickFilter(filterType);
  let response;
  let startDateStr = dayjs().format(DATE_FORMAT);
  let endDateStr = dayjs().format(DATE_FORMAT);

      switch (filterType) {
        case 'today':
          response = await layBaoCaoBanHangHomNay();
          startDateStr = dayjs().format(DATE_FORMAT);
          endDateStr = startDateStr;
          break;
        case 'thisWeek':
          response = await layBaoCaoBanHangTuanNay();
          startDateStr = dayjs().startOf('week').format(DATE_FORMAT);
          endDateStr = dayjs().endOf('week').format(DATE_FORMAT);
          break;
        case 'last1Month':
          const date1M = dayjs().subtract(1, 'month');
          const now1M = dayjs();
          response = await layBaoCaoBanHangChiTiet(date1M.format('YYYY-MM-DD'), now1M.format('YYYY-MM-DD'));
          startDateStr = date1M.format(DATE_FORMAT);
          endDateStr = now1M.format(DATE_FORMAT);
          break;
        case 'last3Months':
          const date3M = dayjs().subtract(3, 'month');
          const now3M = dayjs();
          response = await layBaoCaoBanHangChiTiet(date3M.format('YYYY-MM-DD'), now3M.format('YYYY-MM-DD'));
          startDateStr = date3M.format(DATE_FORMAT);
          endDateStr = now3M.format(DATE_FORMAT);
          break;
        case 'last6Months':
          const date6M = dayjs().subtract(6, 'month');
          const now6M = dayjs();
          response = await layBaoCaoBanHangChiTiet(date6M.format('YYYY-MM-DD'), now6M.format('YYYY-MM-DD'));
          startDateStr = date6M.format(DATE_FORMAT);
          endDateStr = now6M.format(DATE_FORMAT);
          break;
        case 'thisYear':
          const startOfYear = dayjs().startOf('year');
          const endOfYear = dayjs().endOf('year');
          response = await layBaoCaoBanHangChiTiet(startOfYear.format('YYYY-MM-DD'), endOfYear.format('YYYY-MM-DD'));
          startDateStr = startOfYear.format(DATE_FORMAT);
          endDateStr = endOfYear.format(DATE_FORMAT);
          break;
        default:
          response = await layBaoCaoBanHangHomNay();
          startDateStr = dayjs().format(DATE_FORMAT);
          endDateStr = startDateStr;
      }

      setSelectedRange({ start: startDateStr, end: endDateStr });

      if (response && response.success) {
        setData(response.data || []);
        setSummary(response.summary || {
          tongThanhTien: 0,
          soNgay: 0,
          tongSanPham: 0
        });
        if (response.period && response.period.from && response.period.to) {
          setPeriod(response.period);
          setSelectedRange({
            start: response.period.from,
            end: response.period.to
          });
        } else {
          setPeriod({
            from: startDateStr,
            to: endDateStr
          });
        }
        message.success(response.message || 'Tải báo cáo thành công');
      } else {
        message.error(response?.message || 'Không thể tải báo cáo');
        setData([]);
        setSummary({
          tongThanhTien: 0,
          soNgay: 0,
          tongSanPham: 0
        });
      }
    } catch (error) {
      console.error('Error loading report:', error);
      message.error('Có lỗi xảy ra khi tải báo cáo');
      setData([]);
      setSummary({
        tongThanhTien: 0,
        soNgay: 0,
        tongSanPham: 0
      });
    } finally {
      setLoading(false);
    }
  };

  const handleCustomRangeChange = (dates) => {
    if (dates && dates.length === 2) {
      setSelectedRange({
        start: dates[0] ? dates[0].format(DATE_FORMAT) : null,
        end: dates[1] ? dates[1].format(DATE_FORMAT) : null
      });
    } else {
      setSelectedRange({ start: null, end: null });
    }
  };

  const handlePickerOpenChange = (open) => {
    setIsPickerOpen(open);
    if (!open && (!selectedRange.start || !selectedRange.end)) {
      const todayString = dayjs().format(DATE_FORMAT);
      setSelectedRange({ start: todayString, end: todayString });
    }
  };

  const preventPickerScroll = useCallback((event) => {
    event.preventDefault();
  }, []);

  useEffect(() => {
    if (!isPickerOpen) {
      return undefined;
    }

    const dropdowns = document.querySelectorAll('.bao-cao-picker-panel');
    dropdowns.forEach((dropdown) => {
      dropdown.addEventListener('wheel', preventPickerScroll, { passive: false });
    });

    return () => {
      dropdowns.forEach((dropdown) => {
        dropdown.removeEventListener('wheel', preventPickerScroll);
      });
    };
  }, [isPickerOpen, preventPickerScroll]);

  const handleReportTypeChange = (value) => {
    setReportType(value);
    if (value === 'chart') {
      message.info('Chức năng báo cáo dạng biểu đồ đang được phát triển');
    }
  };

  const handleCustomRangeSearch = async () => {
    if (!selectedRange.start || !selectedRange.end) {
      message.warning('Vui lòng chọn khoảng thời gian');
      return;
    }

    try {
      setLoading(true);
      setQuickFilter('custom');
      const startDate = selectedRange.start;
      const endDate = selectedRange.end;
      
      const response = await layBaoCaoBanHangChiTiet(startDate, endDate);
      
      if (response && response.success) {
        setData(response.data || []);
        setSummary(response.summary || {
          tongThanhTien: 0,
          soNgay: 0,
          tongSanPham: 0
        });
        setPeriod(response.period || {
          from: startDate,
          to: endDate
        });
        message.success(response.message || 'Tải báo cáo thành công');
      } else {
        message.error(response?.message || 'Không thể tải báo cáo');
        setData([]);
        setSummary({
          tongThanhTien: 0,
          soNgay: 0,
          tongSanPham: 0
        });
      }
    } catch (error) {
      console.error('Error loading custom range report:', error);
      message.error('Có lỗi xảy ra khi tải báo cáo');
      setData([]);
      setSummary({
        tongThanhTien: 0,
        soNgay: 0,
        tongSanPham: 0
      });
    } finally {
      setLoading(false);
    }
  };

  const handleExport = async () => {
    if (!selectedRange.start || !selectedRange.end) {
      message.warning('Vui lòng chọn khoảng thời gian để xuất báo cáo');
      return;
    }

    try {
      setLoading(true);
      const startDate = selectedRange.start;
      const endDate = selectedRange.end;
      
      const response = await xuatBaoCaoBanHang(startDate, endDate);
      
      if (response && response.success) {
        message.success('Xuất báo cáo thành công');
      } else {
        message.error(response?.message || 'Không thể xuất báo cáo');
      }
    } catch (error) {
      console.error('Error exporting report:', error);
      message.error('Có lỗi xảy ra khi xuất báo cáo');
    } finally {
      setLoading(false);
    }
  };

  const processedData = useMemo(() => {
    if (!data || data.length === 0) return [];
    
    const grouped = [];
    const dateMap = new Map();
    
    data.forEach((item, index) => {
      let dateKey = item.ngay;
      
      // Validate and normalize date - API returns DD/MM/YYYY format
      if (dateKey) {
        const parsedDate = dayjs(dateKey, DISPLAY_FORMAT, true); // strict parsing with DD/MM/YYYY
        if (parsedDate.isValid()) {
          dateKey = parsedDate.format(DATE_FORMAT); // normalize to YYYY-MM-DD
        } else {
          dateKey = 'Invalid Date';
        }
      } else {
        dateKey = 'No Date';
      }
      
      if (!dateMap.has(dateKey)) {
        dateMap.set(dateKey, []);
      }
      dateMap.get(dateKey).push({ ...item, originalIndex: index, normalizedDate: dateKey });
    });
    
    let globalSTT = 1;
    // Sort dates: valid dates first, then Invalid Date, then No Date
    const sortedDates = Array.from(dateMap.keys()).sort((a, b) => {
      if (a === 'Invalid Date') return 1;
      if (b === 'Invalid Date') return -1;
      if (a === 'No Date') return 1;
      if (b === 'No Date') return -1;
      return dayjs(a).isBefore(dayjs(b)) ? -1 : 1;
    });
    
    sortedDates.forEach((date) => {
      const items = dateMap.get(date);
      
      // Calculate sum for this date group
      const dateTotal = items.reduce((sum, item) => {
        return sum + (parseFloat(item.thanhTien) || 0);
      }, 0);
      
      items.forEach((item, idx) => {
        grouped.push({
          ...item,
          stt: globalSTT++,
          dateRowSpan: idx === 0 ? items.length : 0,
          isFirstInGroup: idx === 0,
          isLastInGroup: idx === items.length - 1,
          groupDate: date,
          dateTotal: dateTotal
        });
      });
    });
    
    return grouped;
  }, [data]);

  const columns = [
    {
      title: 'STT',
      dataIndex: 'stt',
      key: 'stt',
      width: 60,
      align: 'center',
      fixed: 'left',
      render: (text, record) => {
        if (record.isFirstInGroup) {
          return {
            children: text,
            props: {
              rowSpan: record.dateRowSpan
            }
          };
        }
        return {
          children: text,
          props: {
            rowSpan: 0
          }
        };
      }
    },
    {
      title: 'Ngày',
      dataIndex: 'ngay',
      key: 'ngay',
      width: 120,
      fixed: 'left',
      render: (text, record) => {
        if (record.isFirstInGroup) {
          let displayDate = '';
          let cellStyle = {};
          
          if (record.normalizedDate === 'Invalid Date') {
            displayDate = 'Invalid Date';
            cellStyle = { color: '#ff4d4f', fontStyle: 'italic' };
          } else if (record.normalizedDate === 'No Date') {
            displayDate = 'No Date';
            cellStyle = { color: '#999', fontStyle: 'italic' };
          } else if (record.normalizedDate) {
            // normalizedDate is already in YYYY-MM-DD format from processedData
            const parsedDate = dayjs(record.normalizedDate, DATE_FORMAT);
            displayDate = parsedDate.isValid() ? parsedDate.format(DISPLAY_FORMAT) : record.normalizedDate;
          }
          
          return {
            children: <span style={cellStyle}>{displayDate}</span>,
            props: {
              rowSpan: record.dateRowSpan
            }
          };
        }
        return {
          children: null,
          props: {
            rowSpan: 0
          }
        };
      }
    },
    {
      title: 'Mã SP',
      dataIndex: 'maSP',
      key: 'maSP',
      width: 100
    },
    {
      title: 'Tên sản phẩm',
      dataIndex: 'tenSP',
      key: 'tenSP',
      width: 300,
      ellipsis: true
    },
    {
      title: 'Số lượng',
      dataIndex: 'soLuong',
      key: 'soLuong',
      width: 100,
      align: 'right',
      render: (text) => text ? parseFloat(text).toLocaleString('vi-VN') : '0'
    },
    {
      title: 'Đơn giá',
      dataIndex: 'donGia',
      key: 'donGia',
      width: 120,
      align: 'right',
      render: (text) => text ? parseFloat(text).toLocaleString('vi-VN') : '0'
    },
    {
      title: 'Giảm giá (%)',
      dataIndex: 'giamGia',
      key: 'giamGia',
      width: 120,
      align: 'right',
      render: (text) => text ? parseFloat(text).toLocaleString('vi-VN') : ''
    },
    {
      title: 'CKTM (%)',
      dataIndex: 'cktm',
      key: 'cktm',
      width: 100,
      align: 'right',
      render: (text) => text ? parseFloat(text).toLocaleString('vi-VN') : ''
    },
    {
      title: 'Thành tiền',
      dataIndex: 'thanhTien',
      key: 'thanhTien',
      width: 150,
      align: 'right',
      fixed: 'right',
      render: (text, record) => {
        if (record.isFirstInGroup) {
          return {
            children: (
              <span className="thanh-tien-column" style={{ fontWeight: 'bold', color: '#197dd3', fontSize: '15px' }}>
                {record.dateTotal.toLocaleString('vi-VN')}
              </span>
            ),
            props: {
              rowSpan: record.dateRowSpan
            }
          };
        }
        return {
          children: null,
          props: {
            rowSpan: 0
          }
        };
      }
    }
  ];

  return (
    <div className="bao-cao-doanh-thu-khach-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Báo cáo' },
          { title: 'Báo cáo bán hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <BarChart size={20} />
            <span>Báo cáo bán hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="filter-section">
          <Row gutter={[16, 16]}>
            <Col xs={24} md={24}>
              <div className="quick-filter-buttons">
                <Button 
                  type={quickFilter === 'today' ? 'primary' : 'default'}
                  onClick={() => loadDataByFilter('today')}
                  icon={<Calendar size={16} />}
                >
                  Hôm nay
                </Button>
                <Button 
                  type={quickFilter === 'thisWeek' ? 'primary' : 'default'}
                  onClick={() => loadDataByFilter('thisWeek')}
                >
                  Tuần này
                </Button>
                <Button 
                  type={quickFilter === 'last1Month' ? 'primary' : 'default'}
                  onClick={() => loadDataByFilter('last1Month')}
                >
                  1 tháng
                </Button>
                <Button 
                  type={quickFilter === 'last3Months' ? 'primary' : 'default'}
                  onClick={() => loadDataByFilter('last3Months')}
                >
                  3 tháng
                </Button>
                <Button 
                  type={quickFilter === 'last6Months' ? 'primary' : 'default'}
                  onClick={() => loadDataByFilter('last6Months')}
                >
                  6 tháng
                </Button>
                <Button 
                  type={quickFilter === 'thisYear' ? 'primary' : 'default'}
                  onClick={() => loadDataByFilter('thisYear')}
                >
                  Năm nay
                </Button>
              </div>
            </Col>
          </Row>

          <Row gutter={[16, 16]} style={{ marginTop: 16 }}>
            <Col xs={24} md={12}>
              <Space.Compact style={{ width: '100%' }}>
                <RangePicker 
                  value={rangePickerValue}
                  onCalendarChange={handleCustomRangeChange}
                  onChange={handleCustomRangeChange}
                  onOpenChange={handlePickerOpenChange}
                  format={DISPLAY_FORMAT}
                  popupClassName="bao-cao-picker-panel"
                  placeholder={['Từ ngày', 'Đến ngày']}
                  style={{ width: '100%' }}
                />
                <Button 
                  type="primary" 
                  onClick={handleCustomRangeSearch}
                >
                  Tìm kiếm
                </Button>
              </Space.Compact>
            </Col>
            <Col xs={24} md={6}>
              <Select
                value={reportType}
                onChange={handleReportTypeChange}
                style={{ width: '100%' }}
                placeholder="Chọn dạng báo cáo"
              >
                <Option value="table">
                  <Space>
                    <Table2 size={16} />
                    <span>Dạng bảng</span>
                  </Space>
                </Option>
                <Option value="chart">
                  <Space>
                    <TrendingUp size={16} />
                    <span>Dạng biểu đồ</span>
                  </Space>
                </Option>
              </Select>
            </Col>
            <Col xs={24} md={6}>
              <Button 
                type="default" 
                icon={<Download size={16} />}
                onClick={handleExport}
                block
              >
                Xuất báo cáo
              </Button>
            </Col>
          </Row>
        </div>

        {period.from && period.to && (
          <div className="period-info">
            <span>
              Kỳ báo cáo: <strong>{dayjs(period.from).isValid() ? dayjs(period.from).format(DISPLAY_FORMAT) : period.from}</strong> đến <strong>{dayjs(period.to).isValid() ? dayjs(period.to).format(DISPLAY_FORMAT) : period.to}</strong>
            </span>
          </div>
        )}

        <Row gutter={[16, 16]} className="summary-section">
          <Col xs={24} sm={8}>
            <Card className="summary-card">
              <Statistic
                title="Tổng doanh thu"
                value={summary.tongThanhTien || 0}
                precision={0}
                suffix="₫"
                valueStyle={{ color: '#197dd3', fontSize: '24px', fontWeight: 'bold' }}
              />
            </Card>
          </Col>
          <Col xs={24} sm={8}>
            <Card className="summary-card">
              <Statistic
                title="Số ngày"
                value={summary.soNgay || 0}
                valueStyle={{ color: '#77d4fb', fontSize: '24px', fontWeight: 'bold' }}
              />
            </Card>
          </Col>
          <Col xs={24} sm={8}>
            <Card className="summary-card">
              <Statistic
                title="Tổng sản phẩm"
                value={summary.tongSanPham || 0}
                valueStyle={{ color: '#197dd3', fontSize: '24px', fontWeight: 'bold' }}
              />
            </Card>
          </Col>
        </Row>

        <Spin spinning={loading}>
          {reportType === 'table' ? (
            <Table
              columns={columns}
              dataSource={processedData}
              rowKey={(record) => `${record.ngay}-${record.maSP}-${record.originalIndex}`}
              pagination={{
                pageSize: 50,
                showSizeChanger: true,
                showTotal: (total) => `Tổng ${total} bản ghi`,
                pageSizeOptions: ['20', '50', '100', '200']
              }}
              scroll={{ x: 1400, y: 500 }}
              className="report-table"
              bordered
              summary={(pageData) => {
                if (pageData.length === 0) return null;
                
                const totalAmount = pageData.reduce((sum, record) => {
                  return sum + (parseFloat(record.thanhTien) || 0);
                }, 0);

                return (
                  <Table.Summary fixed>
                    <Table.Summary.Row className="summary-row">
                      <Table.Summary.Cell index={0} colSpan={8} align="right">
                        <strong>Tổng cộng:</strong>
                      </Table.Summary.Cell>
                      <Table.Summary.Cell index={1} align="right">
                        <strong style={{ color: '#197dd3', fontSize: '16px' }}>
                          {totalAmount.toLocaleString('vi-VN')}
                        </strong>
                      </Table.Summary.Cell>
                    </Table.Summary.Row>
                  </Table.Summary>
                );
              }}
            />
          ) : (
            <div className="chart-placeholder">
              <TrendingUp size={64} style={{ color: '#bdbcc4' }} />
              <h3>Chức năng báo cáo dạng biểu đồ</h3>
              <p>Tính năng này đang được phát triển và sẽ sớm ra mắt</p>
            </div>
          )}
        </Spin>
      </Card>
    </div>
  );
};

export default BaoCaoDoanhThuKhachHang;
