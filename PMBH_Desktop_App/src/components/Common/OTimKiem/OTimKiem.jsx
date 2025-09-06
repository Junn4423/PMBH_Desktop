import React from 'react';
import { Input } from 'antd';
import { SearchOutlined } from '@ant-design/icons';

const OTimKiem = ({
  placeholder = 'Tìm kiếm...',
  value,
  onChange,
  onSearch,
  size = 'middle',
  allowClear = true,
  enterButton = false,
  loading = false,
  className,
  ...props
}) => {
  return (
    <Input.Search
      placeholder={placeholder}
      value={value}
      onChange={onChange}
      onSearch={onSearch}
      size={size}
      allowClear={allowClear}
      enterButton={enterButton}
      loading={loading}
      className={className}
      prefix={<SearchOutlined />}
      {...props}
    />
  );
};

export default OTimKiem;
