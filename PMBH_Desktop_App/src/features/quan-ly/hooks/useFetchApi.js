import {useState, useCallback} from 'react';
import {useAuthStore} from '../../../features/auth/store/login.store';

const useFetchApi = <T = any>(fetchApiFn: (user: any) => Promise<T>) => {
  const {user} = useAuthStore();

  const [data, setData] = useState<T | null>(null);
  const [loading, setLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  const fetchData = useCallback(async () => {
    if (!user) {
      setError('User is not authenticated');
      return;
    }

    setLoading(true);
    setError(null);

    try {
      const response = await fetchApiFn(user);
      setData(response);
    } catch (err) {
      console.log('Fetch error:', err);
      setError('Failed to fetch data');
    } finally {
      setLoading(false);
    }
  }, [user, fetchApiFn]);
  return {
    data,
    loading,
    error,
    refetch: fetchData,
  };
};

export default useFetchApi;
