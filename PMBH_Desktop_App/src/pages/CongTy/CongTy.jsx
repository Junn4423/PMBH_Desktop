import React, { useCallback, useEffect, useMemo, useState } from 'react';
import { Breadcrumb, Card, Table, Input, Button, Typography, Tag, message } from 'antd';
import { Building2, RefreshCw, Search as SearchIcon, Phone, Globe, MapPin, Hash } from 'lucide-react';
import { getDanhSachCongTy } from '../../services/apiServices';
import './CongTy.css';

const { Text } = Typography;
const { Search: SearchInput } = Input;

const normalizeWebsiteUrl = (url) => {
  if (!url) {
    return '';
  }
  const trimmed = String(url).trim();
  if (!trimmed) {
    return '';
  }
  if (/^https?:\/\//i.test(trimmed)) {
    return trimmed;
  }
  return `http://${trimmed}`;
};

const getWebsiteLabel = (url) => {
  const normalized = normalizeWebsiteUrl(url);
  if (!normalized) {
    return '';
  }
  try {
    const parsed = new URL(normalized);
    const hasPath = parsed.pathname && parsed.pathname !== '/';
    return `${parsed.hostname}${hasPath ? parsed.pathname : ''}`;
  } catch (error) {
    return String(url).trim();
  }
};

const filterCompaniesByKeyword = (items, keyword) => {
  if (!keyword) {
    return items;
  }
  const lowerKeyword = keyword.toLowerCase();
  return items.filter((item) => {
    const values = [
      item?.maCongTy,
      item?.tenCongTy,
      item?.diaChi,
      item?.giamDoc,
      item?.dienThoai,
      item?.maSoThue,
      item?.website
    ]
      .filter(Boolean)
      .map((value) => String(value).toLowerCase());
    return values.some((value) => value.includes(lowerKeyword));
  });
};

const CongTy = () => {
  const [companies, setCompanies] = useState([]);
  const [filteredCompanies, setFilteredCompanies] = useState([]);
  const [loading, setLoading] = useState(false);
  const [searchValue, setSearchValue] = useState('');

  const loadCompanies = useCallback(async () => {
    setLoading(true);
    try {
      const data = await getDanhSachCongTy();
      const list = Array.isArray(data) ? data : [];
      setCompanies(list);
    } catch (error) {
      console.error('Failed to load company list', error);
      message.error('Không thể tải danh sách công ty, vui lòng thử lại.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    loadCompanies();
  }, [loadCompanies]);

  useEffect(() => {
    const keyword = searchValue.trim();
    setFilteredCompanies(filterCompaniesByKeyword(companies, keyword));
  }, [companies, searchValue]);

  const summary = useMemo(() => {
    const total = companies.length;
    const visible = filteredCompanies.length;
    const withWebsite = filteredCompanies.filter((item) => item?.website).length;
    const withTaxCode = filteredCompanies.filter((item) => item?.maSoThue).length;
    return { total, visible, withWebsite, withTaxCode };
  }, [companies, filteredCompanies]);

  const columns = useMemo(
    () => [
      {
        title: 'Mã công ty',
        dataIndex: 'maCongTy',
        key: 'maCongTy',
        width: 140,
        render: (value) =>
          value ? <Tag color="geekblue">{value}</Tag> : <Text type="secondary">—</Text>
      },
      {
        title: 'Tên công ty',
        dataIndex: 'tenCongTy',
        key: 'tenCongTy',
        render: (value, record) => (
          <div className="company-name-cell">
            <Text strong>{value || '—'}</Text>
            {record.website && (
              <div className="company-contact-line">
                <Globe size={14} />
                <a href={normalizeWebsiteUrl(record.website)} target="_blank" rel="noopener noreferrer">
                  {getWebsiteLabel(record.website)}
                </a>
              </div>
            )}
          </div>
        )
      },
      {
        title: 'Địa chỉ',
        dataIndex: 'diaChi',
        key: 'diaChi',
        render: (value) =>
          value ? (
            <div className="company-contact-line">
              <MapPin size={14} />
              <span>{value}</span>
            </div>
          ) : (
            <Text type="secondary">—</Text>
          )
      },
      {
        title: 'Giám đốc',
        dataIndex: 'giamDoc',
        key: 'giamDoc',
        width: 180,
        render: (value) => value || <Text type="secondary">—</Text>
      },
      {
        title: 'Liên hệ',
        key: 'contact',
        width: 220,
        render: (_, record) => (
          <div className="company-contact-stack">
            {record.dienThoai && (
              <div className="company-contact-line">
                <Phone size={14} />
                <span>{record.dienThoai}</span>
              </div>
            )}
            {record.fax && (
              <div className="company-contact-line">
                <Hash size={14} />
                <span>Fax: {record.fax}</span>
              </div>
            )}
            {record.maSoThue && (
              <div className="company-contact-line">
                <Hash size={14} />
                <span>MST: {record.maSoThue}</span>
              </div>
            )}
          </div>
        )
      }
    ],
    []
  );

  return (
    <div className="company-page">
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Mục chung</Breadcrumb.Item>
        <Breadcrumb.Item>Công ty</Breadcrumb.Item>
      </Breadcrumb>

      <Card
        className="company-card"
        title={
          <div className="company-title">
            <Building2 size={20} />
            <span>Danh sách công ty</span>
          </div>
        }
        extra={
          <div className="company-controls">
            <SearchInput
              placeholder="Tìm kiếm theo mã, tên, địa chỉ..."
              allowClear
              prefix={<SearchIcon size={16} />}
              value={searchValue}
              onChange={(event) => setSearchValue(event.target.value)}
              onSearch={(value) => setSearchValue(value ?? '')}
              style={{ width: 280 }}
              enterButton={false}
            />
            <Button
              icon={<RefreshCw size={16} />}
              onClick={loadCompanies}
              loading={loading}
            >
              Tải lại
            </Button>
          </div>
        }
      >
        <div className="company-summary">
          <Tag color="geekblue">Tổng: {summary.total}</Tag>
          <Tag color="green">Hiển thị: {summary.visible}</Tag>
          <Tag color="purple">Có website: {summary.withWebsite}</Tag>
          <Tag color="magenta">Có MST: {summary.withTaxCode}</Tag>
        </div>

        <Table
          className="company-table"
          columns={columns}
          dataSource={filteredCompanies}
          loading={loading}
          rowKey={(record, index) => record.maCongTy || `${record.tenCongTy || 'company'}-${index}`}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `${total} công ty`
          }}
          expandable={{
            expandedRowRender: (record) => (
              <div className="company-expanded">
                {record.maCongTyCha && (
                  <div className="company-expanded-item">
                    <strong>Mã công ty cha:</strong>
                    <span>{record.maCongTyCha}</span>
                  </div>
                )}
                {record.capBac && (
                  <div className="company-expanded-item">
                    <strong>Cấp bậc:</strong>
                    <span>{record.capBac}</span>
                  </div>
                )}
                {record.maTinh && (
                  <div className="company-expanded-item">
                    <strong>Tỉnh/Bang:</strong>
                    <span>{record.maTinh}</span>
                  </div>
                )}
                {record.maQuocGia && (
                  <div className="company-expanded-item">
                    <strong>Quốc gia:</strong>
                    <span>{record.maQuocGia}</span>
                  </div>
                )}
                {record.logo && (
                  <div className="company-expanded-item">
                    <strong>Logo:</strong>
                    <span>{record.logo}</span>
                  </div>
                )}
              </div>
            ),
            rowExpandable: (record) =>
              Boolean(
                record.maCongTyCha ||
                record.capBac ||
                record.maTinh ||
                record.maQuocGia ||
                record.logo
              )
          }}
          locale={{ emptyText: 'Không có dữ liệu' }}
        />
      </Card>
    </div>
  );
};

export default CongTy;
